<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionsController::class, 'destroy']);

    Route::get('/decks', [DeckController::class, 'index'])
        ->name('decks.index');

    Route::get('/decks/create', [DeckController::class, 'create'])
        ->name('decks.create');

    Route::post('/decks', [DeckController::class, 'store'])
        ->name('decks.store');

    Route::get('/decks/{deck}/edit', [DeckController::class, 'edit'])
        ->middleware('can:update,deck')
        ->name('decks.edit');

    Route::patch('/decks/{deck}', [DeckController::class, 'update'])
        ->middleware('can:update,deck')
        ->name('decks.update');

    Route::delete('/decks/{deck}', [DeckController::class, 'delete'])
        ->middleware('can:delete,deck')
        ->name('decks.delete');

    Route::get('/decks/{deck}/study', [DeckController::class, 'study'])
        ->middleware('can:view,deck')
        ->name('decks.study');

    Route::get('/decks/{deck}/flashcards/create', [FlashcardController::class, 'create'])
        ->middleware('can:update,deck')
        ->name('flashcards.create');

    Route::post('/decks/{deck}/flashcards', [FlashcardController::class, 'store'])
        ->middleware('can:update,deck')
        ->name('flashcards.store');

    Route::get('/flashcards/{flashcard}/edit', [FlashcardController::class, 'edit'])
        ->middleware('can:update,flashcard')
        ->name('flashcards.edit');

    Route::patch('/flashcards/{flashcard}', [FlashcardController::class, 'update'])
        ->middleware('can:update,flashcard')
        ->name('flashcards.update');

    Route::delete('/flashcards/{flashcard}', [FlashcardController::class, 'delete'])
        ->middleware('can:delete,flashcard')
        ->name('flashcards.delete');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);

    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionsController::class, 'store']);
});