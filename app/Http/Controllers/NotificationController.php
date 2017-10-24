<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        foreach ($notifications as $notification)
        {
            $this->postMarkAsSeen($notification);
        }

        return view('pages.notification.index')->with('notifications', $notifications);
    }

    public function postMarkAsSeen($notification)
    {
        $notification->seen = 1;
        $notification->save();
    }
}
