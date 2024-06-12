<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;
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

    /* public function sendWindowsNotification()
    {
        $user = User::first(); // Get the first user or use authenticated user

        $user->notify(new PushNotification());

        return response()->json(['success' => true]);
    } */

    public function sendNotification()
    {
        $user = User::first(); // Get the first user or use authenticated user

        try {
            // $user->notify(new PushNotification());
            Notification::send($user, new PushNotification());
            print('true');
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            print('false' . $e);
        }

        return response()->json(['success' => true]);
        // return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->notifications()->find($request->id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
