<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthManager extends Controller
{
    function login() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    function register() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $remember = $request->has('remember');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials,$remember)) {
            return redirect()->route('home');
        }

        return redirect()->back()->with("error", "Invalid credentials");
    }

    function registerPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ], [
            'username.unique' => 'The username has already been taken.',
            'email.unique' => 'The email has already been registered.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        if (!$user) {
            return redirect()->back()->with('error', 'Failed to register');
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }


    function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

}
