<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FlashcardController extends Controller
{
    public function create(Deck $deck): View
    {
        return view('flashcards.create', [
            'deck' => $deck,
        ]);
    }

    public function store(Request $request, Deck $deck): RedirectResponse
    {
        $validated = $request->validate([
            'front_text' => ['nullable', 'string', 'required_without:front_image'],
            'front_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
                'required_without:front_text',
            ],
            'back_text' => ['nullable', 'string', 'required_without:back_image'],
            'back_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
                'required_without:back_text',
            ],
        ]);

        $flashcardData = [
            'front_text' => $validated['front_text'] ?? null,
            'back_text' => $validated['back_text'] ?? null,
        ];

        if ($request->hasFile('front_image')) {
            $flashcardData['front_image_path'] = $request
                ->file('front_image')
                ->store('flashcards', 'public');
        }

        if ($request->hasFile('back_image')) {
            $flashcardData['back_image_path'] = $request
                ->file('back_image')
                ->store('flashcards', 'public');
        }

        $deck->cards()->create($flashcardData);

        return redirect("/decks/{$deck->id}/study");
    }

    public function edit(Flashcard $flashcard): View
    {
        return view('flashcards.edit', [
            'flashcard' => $flashcard,
        ]);
    }

    public function update(Request $request, Flashcard $flashcard): RedirectResponse
    {
        $validated = $request->validate([
            'front_text' => ['nullable', 'string'],
            'front_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],
            'back_text' => ['nullable', 'string'],
            'back_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],
            'remove_front_image' => ['nullable', 'boolean'],
            'remove_back_image' => ['nullable', 'boolean'],
        ]);

        $flashcardData = [
            'front_text' => $validated['front_text'] ?? null,
            'back_text' => $validated['back_text'] ?? null,
        ];

        if ($request->boolean('remove_front_image')) {
            if ($flashcard->front_image_path) {
                Storage::disk('public')->delete($flashcard->front_image_path);
            }

            $flashcardData['front_image_path'] = null;
        }

        if ($request->hasFile('front_image')) {
            if ($flashcard->front_image_path) {
                Storage::disk('public')->delete($flashcard->front_image_path);
            }

            $flashcardData['front_image_path'] = $request
                ->file('front_image')
                ->store('flashcards', 'public');
        }

        if ($request->boolean('remove_back_image')) {
            if ($flashcard->back_image_path) {
                Storage::disk('public')->delete($flashcard->back_image_path);
            }

            $flashcardData['back_image_path'] = null;
        }

        if ($request->hasFile('back_image')) {
            if ($flashcard->back_image_path) {
                Storage::disk('public')->delete($flashcard->back_image_path);
            }

            $flashcardData['back_image_path'] = $request
                ->file('back_image')
                ->store('flashcards', 'public');
        }

        $flashcard->update($flashcardData);

        return redirect("/decks/{$flashcard->deck_id}/study");
    }

    public function delete(Flashcard $flashcard): RedirectResponse
    {
        $deckId = $flashcard->deck_id;

        if ($flashcard->front_image_path) {
            Storage::disk('public')->delete($flashcard->front_image_path);
        }

        if ($flashcard->back_image_path) {
            Storage::disk('public')->delete($flashcard->back_image_path);
        }

        $flashcard->delete();

        return redirect("/decks/{$deckId}/study");
    }
}
