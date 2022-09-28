<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notifications.index', [
            'notifications' => auth()->user()->notifications,
            'unreadNotifications' => auth()->user()->unreadNotifications,
            'readNotifications' => auth()->user()->readNotifications,
        ]);
    }

    public function bid($id)
    {
        $bid = Bid::findOrFail($id);

        return view('notifications.show', compact('bid'));
    }

    public function show($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        
        $bid_id = $notification->data['bid'];

        $bid = Bid::findOrFail($bid_id);

        return view('notifications.show', compact('notification', 'bid'));
    }

    public function read($id)
    {
        DatabaseNotification::find($id)->markAsRead();
        $bid_id = DatabaseNotification::find($id)->data['bid'];
        // dd($bid);
        // return back()->with('flash', 'Notification mark as read');
        return redirect()->route('notifications.bid', $bid_id);
    }

    public function destroy($id)
    {
        DatabaseNotification::find($id)->delete();

        return back()->with('flash', 'Notification deleted');
    }
}
