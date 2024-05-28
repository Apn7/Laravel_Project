<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\User;
use App\Events\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    public function follow(Request $request)
    {
        // Find the user by their username
        $user_id = $request->input('user_id');


        $follower = auth()->user();

        $isFollowing = $follower->following()->where('user_id', $user_id)->exists();

        $follower->following()->toggle($user_id);


        $userToFollow = User::find($user_id);
        $tfollower = User::find($follower->id);

        if (!$isFollowing) {
            event(new UserFollowed($tfollower, $userToFollow));
        }


        return back();
    }

    public function editProfileView($username)
    {
        $user = User::where('username', $username)->first();
        return view('edit_user_info', ['user' => $user]);
    }

    public function editProfile(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'bio' => 'nullable|string',
        ]);

        $userID = auth()->id();
        $user = User::find($userID);

        $user->update($formFields);

        return redirect()->route('profile', ['username' => $user->username]);

    }

    public function editPass(Request $request)
    {
        $request->validate([
            'current' => 'required',
            'new' => 'required|confirmed',
        ]);

        $userID = auth()->id();
        $user = User::find($userID);


        if (!(Hash::check($request->current, $user->password))) {
            return redirect()->back()->withErrors(['current' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');
        $authUserId = auth()->id(); // Get the authenticated user's ID

        $users = User::where('id', '!=', $authUserId) // Exclude the authenticated user
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('username', 'like', "%$query%");
            })
            ->get();

        return view('searched_users', ['users' => $users]);
    }


}
