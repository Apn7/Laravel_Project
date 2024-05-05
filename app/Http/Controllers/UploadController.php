<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadController extends Controller
{
    public function upload(Request $request)
    {


        $formFields = $request->validate([
            'description' => 'required',
            'tags' => 'nullable|string'
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
        

        Meme::create($formFields);

        return redirect()->route('home');

    }
}
