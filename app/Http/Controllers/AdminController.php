<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\User;
use App\Models\MemeContext;
use App\Models\ReportedMeme;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public function index()
    {
        $memes = Meme::all();
        $reports = ReportedMeme::all();
        $users = User::all();
        return view('admin.index', compact('memes', 'reports', 'users'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users',compact('users'));
    }

    public function reports()
    {
        $reports = ReportedMeme::with('meme', 'user')->get();
        return view('admin.reported_memes', compact('reports'));
    }

    public function deteleReport(Request $request)
    {
        $reportId = $request->input('report_id');
        $report = ReportedMeme::find($reportId);
        $report->meme->delete();
        $report->delete();
        return back();
    }

    public function deleteUser(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $user->delete();
        return back();
    }

    public function makeAdmin(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $user->is_admin = true;
        $user->save();
        return back();
    }

    public function context()
    {
        return view('admin.context_upload');
    }

    public function uploadContext(Request $request)
    {

        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imgurl' => 'required|image'
        ]);

        if ($request->hasFile('imgurl')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('imgurl')->getClientOriginalExtension();
            $image = $manager->read($request->file('imgurl'));
            $image->resize(500,500);
            $image->save(base_path('public/storage/memes_context/' . $name_gen));
            $formFields['imgurl'] = 'memes_context/' . $name_gen;
        }

        MemeContext::create($formFields);

        return back();
    }
}
