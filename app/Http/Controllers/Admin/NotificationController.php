<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function send(Request $req) {
        $user_id = $req->selected_user;
        $content = $req->content;
        
        $user = User::findOrFail($user_id);
        $notification = new Notification(['content' => $content]);

        $notification->user()->associate($user);
        $notification->save();
    }
}
