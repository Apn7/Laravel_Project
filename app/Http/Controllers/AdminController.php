<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReportedMeme;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.index');
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
}
