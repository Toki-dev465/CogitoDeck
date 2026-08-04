<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;
use Illuminate\Support\Facades\Route;

// Flashcards dashboard

Route::view('/', 'welcome')->name('home');

//logout
Route::delete('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth');

Route::get('/decks', function () {
    return view('decks.index');
})->middleware('auth')->name('decks.index');

Route::middleware('guest')->group(function() {   

// register

Route::get('/register', [RegisterUserController::class, 'create']);

Route::post('/register', [RegisterUserController::class, 'store']);
  
//login

Route::get('/login', [SessionsController::class, 'create'])->name('login');

Route::post('/login', [SessionsController::class, 'store']);

});
