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

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect()->back()->with("error", "Invalid credentials");
    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);

        $user = User::create($data);

        if (!$user) {
            return redirect()->back()->with('error', 'Failed to register');
        }
        return redirect()->route('login')->with('success','Registration successful. Please login');
    }

    function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

}
