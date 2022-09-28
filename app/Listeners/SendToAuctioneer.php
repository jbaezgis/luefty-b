<?php

namespace App\Listeners;

use App\Events\AuctionWon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendToAuctioneer implements ShouldQueue
{
    // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
     * @param  AuctionWon  $event
     * @return void
     */
    public function handle(AuctionWon $event)
    {
        $bid = $event->bid;

        // dd($bid->user->email, $bid->user->name);

        Mail::send('mails.auctioneer', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->auction->user->email, $bid->auction->user->name)->subject(trans('globals.auction_success'));
        });
    }
}
