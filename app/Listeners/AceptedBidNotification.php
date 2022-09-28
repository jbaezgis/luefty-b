<?php

namespace App\Listeners;

use App\Events\AuctionBidAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class AceptedBidNotification implements ShouldQueue
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
     * @param  AuctionBidAccepted  $event
     * @return void
     */
    public function handle(AuctionBidAccepted $event)
    {
        $bid = $event->bid;

        Mail::send('mails.bid_accepted', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->user->email, $bid->user->name)->subject(__('Bid Accepted'));
        });
    }
}
