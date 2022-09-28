<?php

namespace App\Listeners;

use App\Events\NewAuctionNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class NewAuctionB2BNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewAuctionNotification  $event
     * @return void
     */
    public function handle(NewAuctionNotification $event)
    {
        $auction = $event->auction;
        $users = App\User::get();

        foreach ($users as $user) {
            Mail::send('mails.b2b.new_auction', ['msg' => $auction], function($m) use ($auction,$user){
                $m->from('info@luefty.com', 'Luefty');
                $m->to($user->email, $user->name)->subject(__('New Auction Created!'));
            });
        }

        // Mail::send('mails.b2b.new_auction', ['msg' => $auction], function($m) use ($auction){
        //     $m->from('info.luefty@gmail.com', 'Luefty');
        //     $m->to('jbaezgis@gmail.com', 'Yoel')->subject(__('New Auction Created!'));
        // });
    }
}
