<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
    public function profile($username)
    {
        // Find the user by their username
        $user = User::where('username', $username)->first();

        // If the user doesn't exist, return a 404 response
        if (!$user) {
            abort(404);
        }

        // Load the user's memes and return the profile view
        $memes = Meme::where('user_id', $user->id)->paginate(2);
        return view('profile', ['user' => $user, 'memes' => $memes]);
    }
}
