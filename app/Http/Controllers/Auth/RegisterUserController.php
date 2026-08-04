<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{

    // show the registration form
    public function create()
    {
        return view('auth/register');
    }
    

    public function store(Request $request)
    {
        // validate the request

       $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required',  'min:8'],
        ]);
        
    
        // create the user in the database

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // log the user in

        Auth ::login($user);

        // redirect to the home page

        return redirect('/decks');
    }




}
