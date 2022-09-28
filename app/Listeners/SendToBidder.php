<?php

namespace App\Listeners;

use App\Events\AuctionWon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SendToBidder implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  AuctionWon  $event
     * @return void
     */
    public function handle(AuctionWon $event)
    {
        $bid = $event->bid;

        // dd($bid->user->email, $bid->user->name);

        Mail::send('mails.bidder', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->user->email, $bid->user->name)->subject(__('Auction Success!'));
        });
    }
}
