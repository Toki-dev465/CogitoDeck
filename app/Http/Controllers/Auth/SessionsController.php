<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
   

    // show login form
    public function create()
    {
        return view('auth/login');
    }

    // login
    public function store(Request $request)
    {
        // validate the request

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required',  'min:8'],
        ]);

        // log the user in
        if (Auth::attempt($validated)){

            $request->session()->regenerate();

            return redirect('/decks');
        }

        return back()-> withErrors(['email' => 'Invalid Credentials']);
    }

    

    // logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
