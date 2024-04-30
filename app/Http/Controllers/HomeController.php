<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Meme;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $memes = Meme::all();
        return view('welcome', ['memes' => $memes]);
    }

    public function like(Request $request)
    {
        // Get the meme ID from the request
        $memeId = $request->input('meme_id');

        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Check if the user has already liked the meme
        $existingLike = Like::where('user_id', $userId)->where('meme_id', $memeId)->first();

        if ($existingLike) {
            // User has already liked the meme, you can delete the like here
            $existingLike->delete();

            // Optionally, you can return a success message or redirect the user
        } else {
            // User hasn't liked the meme, create a new like
            Like::create([
                'user_id' => $userId,
                'meme_id' => $memeId,
            ]);
            // Optionally, you can return a success message or redirect the user
        }
        return back();
    }

    public function comment(Request $request)
    {
        // Get the meme ID and comment content from the request
        $memeId = $request->input('meme_id');
        $content = $request->input('content');

        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Create a new comment
        Comment::create([
            'user_id' => $userId,
            'meme_id' => $memeId,
            'content' => $content,
        ]);

        // Optionally, you can return a success message or redirect the user
        return back();
    }

    public function deleteComment(Request $request)
    {
        // Get the comment ID from the request
        $commentId = $request->input('comment_id');

        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Find the comment by ID and user ID
        $comment = Comment::where('id', $commentId)->where('user_id', $userId)->first();

        if ($comment) {
            // User is authorized to delete the comment, you can delete it here
            $comment->delete();

            // Optionally, you can return a success message or redirect the user
        } else {
            // User is not authorized to delete the comment, you can return an error message or redirect the user
        }
        return back();
    }

}
