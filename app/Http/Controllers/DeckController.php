<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View 

    {
        return view ('decks.index', [
            'decks' => Auth::user()
                ->decks()
                ->withCount('cards')
                ->latest()
                ->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('decks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate form

        $validated = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        // create a new deck
        Auth::user()->decks()->create($validated);
        
        return redirect('/decks');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('decks.edit', [
            'deck' => $deck,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck): RedirectResponse
    {   // validate form
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            
        ]);

        $deck->update($validated);

        return redirect('/decks');

    }

    public function study(Deck $deck): View
    {
        return view('decks.study', [
            'deck' => $deck->load('cards'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Deck $deck): RedirectResponse
    {
        $deck->delete();
        return redirect('/decks');
    }
}
