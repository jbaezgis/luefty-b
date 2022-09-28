<?php

namespace App\Listeners;

use App\Events\NewBidNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class NewBidAuctioneerNotification implements ShouldQueue
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
     * @param  NewBidNotification  $event
     * @return void
     */
    public function handle(NewBidNotification $event)
    {
        $bid = $event->bid;

        Mail::send('bookings.mails.new_bid', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->auction->user->email, $bid->auction->user->name)->subject(__('You have a new bid!'));
        });
    }
}
