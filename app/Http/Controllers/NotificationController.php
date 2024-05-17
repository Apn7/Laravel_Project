<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        //if (auth()->id()!= ){
            $notifications = Notification::where('user_id', auth()->id())->latest()->get();
        //}

        return view('notifications', ['notifications' => $notifications]);
    }

    public function markAsRead($notificationId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $notification = Notification::find($notificationId);
        if ($notification && $notification->user_id == auth()->id()) {
            $notification->read = true;
            $notification->save();
        }
        // check if notifiable id is meme id
        if ($notification->notifiable_type == 'App\Models\Meme') {
            $meme = Meme::find($notification->notifiable_id);
            if ($meme){
                return redirect()->route('meme', $notification->notifiable_id);
            }
            else{
                //return error
                abort(404);
            }
        }
        // check if notifiable id is user id
        if ($notification->notifiable_type == 'App\Models\User') {
            $user = User::find($notification->notifiable_id);
            if ($user){
                return redirect()->route('profile', $user->username);
            }
            else{
                //return error
                abort(404);
            }
        }

    }
}
