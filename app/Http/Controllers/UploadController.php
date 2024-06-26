<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\User;
use App\Events\MemeUploaded;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadController extends Controller
{
    public function upload(Request $request)
    {


        $formFields = $request->validate([
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'imgurl' => 'required|image'
        ]);

        if ($request->hasFile('imgurl')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('imgurl')->getClientOriginalExtension();
            $image = $manager->read($request->file('imgurl'));
            $image->resize(500,600);
            $image->save(base_path('public/storage/memes/' . $name_gen));
            $formFields['imgurl'] = 'memes/' . $name_gen;
        }

        $formFields['user_id'] = auth()->id();
        $user = User::find(auth()->id());

        $meme = Meme::create($formFields);

        // Trigger the event after the meme is successfully saved
        event(new MemeUploaded($user, $meme));

        // Set a success message in the session
        session()->flash('success', 'Meme uploaded successfully!');

        return redirect()->route('home');

    }

    public function uploadDp(Request $request)
    {

        $formFields = $request->validate([
            'avatar' => 'required|image'
        ]);

        if ($request->hasFile('avatar')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $image = $manager->read($request->file('avatar'));
            $image->resize(400,400);
            $image->save(base_path('public/storage/users_dp/' . $name_gen));
            $formFields['avatar'] = 'users_dp/' . $name_gen;
        }

        $userID = auth()->id();

        $user = User::find($userID);

        $user->update($formFields);

        // Set a success message in the session
        session()->flash('success', 'Profile picture updated successfully!');

        return redirect()->route('profile', ['username' => $user->username]);
    }


}
