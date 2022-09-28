<?php

namespace App\Listeners;

use App\Events\AuctionNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SendAgentAuctionNotification implements ShouldQueue
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
     * @param  AuctionNotification  $event
     * @return void
     */
    public function handle(AuctionNotification $event)
    {
        $auction = $event->auction;

        // dd($auction->user->email, $auction->user->name);

        Mail::send('bookings.mails.new_auction', ['msg' => $auction], function($m) use ($auction){
            $m->from('info@luefty.com', 'Luefty');
            // $m->to('jbaezgis@gmail.com', 'Luefty')->subject(__('New Auction Created!'));
            $m->to('info@luefty.com', 'Luefty')->subject(__('New Auction Created!'));
        });
    }
}
