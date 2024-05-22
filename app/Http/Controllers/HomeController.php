<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Meme;
use App\Models\User;
use App\Models\Comment;
use App\Events\MemeLiked;
use App\Models\ReportedMeme;
use Illuminate\Http\Request;
use App\Events\MemeCommented;
use App\Models\MemeContext;

class HomeController extends Controller
{

    public function index()
    {
        $memes = Meme::latest()->filter
            (request(['tag','search']))->paginate(3);

        $topTags = $this->getTopTags();

        return view('welcome', ['memes' => $memes , 'topTags' => $topTags]);
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

            //create event for notification
            $user = User::find($userId);
            $meme = Meme::find($memeId);
            if ($user->id != $meme->user_id) {
                event(new MemeLiked($user, $meme));
            }
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
        //trigger event for notification
        $user = User::find($userId);
        $meme = Meme::find($memeId);
        if ($user->id != $meme->user_id) {
            event(new MemeCommented($user, $meme));
        }
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


    public function deleteMeme(Request $request)
    {
        // Get the meme ID from the request
        $memeId = $request->input('meme_id');

        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Find the meme by ID and user ID
        $meme = Meme::where('id', $memeId)->where('user_id', $userId)->first();

        if ($meme) {
            // User is authorized to delete the meme, you can delete it here
            $meme->delete();
            // Optionally, you can return a success message or redirect the user
        }else{
            // User is not authorized to delete the meme, you can return an error message or redirect the user
        }
        return redirect()->route('home');
    }

    public function editMeme(Request $request)
    {
        // Get the meme ID and new content from the request
        $memeId = $request->input('meme_id');
        $newDescription = $request->input('description');

        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Find the meme by ID and user ID
        $meme = Meme::where('id', $memeId)->where('user_id', $userId)->first();

        if ($meme) {
            // User is authorized to edit the meme, you can update the content here
            $meme->description = $newDescription;
            $meme->save();
            // Optionally, you can return a success message or redirect the user
        }else{
            // User is not authorized to edit the meme, you can return an error message or redirect the user
        }
        return view('edit_Meme', ['meme' => $meme]);
    }


    public function editMemeTags(Request $request)
    {
        $memeId = $request->input('meme_id');
        $newTags = $request->input('tags');

        $userId = auth()->id();
        $meme = Meme::where('id',$memeId)->where('user_id',$userId)->first();

        if ($meme){
            $meme->tags = $newTags;
            $meme->save();
        }
        else{

        }
        return view('edit_meme', ['meme'=> $meme]);
    }

    public function editMemeView($memeId)
    {
        // Find the meme by ID
        $meme = Meme::find($memeId);

        // Optionally, you can check if the meme exists and if the authenticated user is the owner
        // before allowing them to edit the meme

        return view('edit_Meme', ['meme' => $meme]);
    }


    public function myFeed()
    {
        // Get the authenticated user's ID (assuming you're using authentication)
        $userId = auth()->id();

        // Get the IDs of the users that the authenticated user is following
        $followingIds = User::find($userId)->following()->pluck('user_id');

        $topTags = $this->getTopTags();

        // Get the memes of the users that the authenticated user is following
        $memes = Meme::whereIn('user_id', $followingIds)->latest()->paginate(3);

        return view('my_feed', ['memes' => $memes], ['topTags' => $topTags]);
    }

    public function trendingMemes()
    {
        // Fetch trending memes
        $memes = Meme::trending()->paginate(3);

        $topTags = $this->getTopTags();

        return view('trending_memes', ['memes' => $memes, 'topTags' => $topTags]);
    }

    public function meme($memeId)
    {
        // Find the meme by ID
        $meme = Meme::find($memeId);

        // Optionally, you can check if the meme exists and if the authenticated user is the owner
        // before allowing them to view the meme

        return view('meme_details', ['meme' => $meme]);
    }

    public function getTopTags()
    {
        // Fetch all tags from the Meme model
        $tags = Meme::pluck('tags'); // This plucks tags from all memes

        $tagCount = collect();

        // Split tags and count occurrences
        foreach ($tags as $tagString) {
            $individualTags = explode(',', $tagString);
            foreach ($individualTags as $tag) {
                $tag = trim($tag);
                if ($tag !== '') {
                    $tagCount->put($tag, $tagCount->get($tag, 0) + 1);
                }
            }
        }

        // Sort by count and take top 10
        $topTags = $tagCount->sortDesc()->take(10);

        return $topTags;
    }

    public function report(Request $request){
        $memeId = $request->input('meme_id');
        $userId = auth()->id();

        return view('reportMeme', ['meme_id' => $memeId, 'user_id' => $userId]);
    }

    public function reportPost(Request $request){
        $request->validate([
            'reason' => 'required',
        ]);
        $memeId = $request->input('meme_id');
        $userId = auth()->id();
        $reason = $request->input('reason');

        ReportedMeme::create([
            'meme_id' => $memeId,
            'user_id' => $userId,
            'reason' => $reason,
        ]);

        return redirect()->back()->with('success', 'Meme reported successfully');
    }

    public function memeContext(){
        $memeContexts = MemeContext::latest()->paginate(3);
        $topTags = $this->getTopTags();
        return view('meme_Contexts', ['memeContexts' => $memeContexts, 'topTags' => $topTags]);
    }

}
