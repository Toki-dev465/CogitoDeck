<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class FlashcardController extends Controller
{
    public function create(Deck $deck): View
    {
        return view('flashcards.create', [
            'deck' => $deck,

        ]);
    }







    public function store(Request $request , Deck $deck): RedirectResponse
    {
        $validated = $request->validate([
            'front_text' => ['required', 'string' ],
            'back_text' => ['required', 'string'],
        ]);

        $deck->cards()->create($validated);

        return redirect("/decks/{$deck->id}/study");

    }


    public function edit(Flashcard $flashcard): View
    {
        return view('flashcards.edit', [
            'flashcard' => $flashcard,
        ]);
    }

    public function update (Request $request, Flashcard $flashcard): RedirectResponse
    {
        $validated = $request->validate([
            'front_text' => ['required', 'string' ],
            'back_text' => ['required', 'string'],
        ]);

        $flashcard->update($validated);

        return redirect("/decks/{$flashcard->deck_id}/study");
    }

    public function delete(Flashcard $flashcard): RedirectResponse
    {
        $deckId = $flashcard->deck_id;

        $flashcard->delete();

        return redirect("/decks/{$deckId}/study");
    }


}
