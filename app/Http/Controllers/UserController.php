<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){

        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username') ],
            'email'    => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created');
    }

    public function login(Request $request){

        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            // return redirect('/')->with('success', 'You are logged in');
           $request->session()->regenerate();
            return redirect('/')->with('success', 'You are logged in');
        } else {
            return redirect('/')->with('error', 'Invalid credentials');
            // return 'Sorry ! Invalid credentials';
        } 

    }

    public function logout(Request $request){
        auth()->logout();
        return redirect('/')->with('success', 'You are logged out');
    }


    public function showCorrectHomepage() {
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }
}
