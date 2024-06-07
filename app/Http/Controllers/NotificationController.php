<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PushNotification;
use Illuminate\Http\Request;
use NotificationChannels\WebPush\PushSubscription;

class NotificationController extends Controller
{
    public function saveSubscription(Request $request)
    {
        $user = User::first(); // Get the first user or use authenticated user

        $user->updatePushSubscription(
            $request->endpoint,
            $request->keys['p256dh'],
            $request->keys['auth']
        );

        return response()->json(['success' => true]);
    }

    public function sendNotification()
    {
        $user = User::first(); // Get the first user or use authenticated user

        $user->notify(new PushNotification());

        return response()->json(['success' => true]);
    }
}
