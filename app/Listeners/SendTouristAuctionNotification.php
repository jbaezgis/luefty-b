<?php

namespace App\Listeners;

use App\Events\AuctionNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SendTouristAuctionNotification implements ShouldQueue
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

        Mail::send('bookings.mails.tourist_auction', ['msg' => $auction], function($m) use ($auction){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($auction->email, $auction->full_name)->subject(__('Your auction was successfully created!'));
        });
    }
}
