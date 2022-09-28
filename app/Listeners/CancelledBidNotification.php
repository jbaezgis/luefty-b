<?php

namespace App\Listeners;

use App\Events\AuctionBidCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class CancelledBidNotification
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
     * @param  AuctionBidCancelled  $event
     * @return void
     */
    public function handle(AuctionBidCancelled $event)
    {
        $bids_cancelled = $event->bids_cancelled;

        foreach ($event->bids_cancelled as $bid) {
            // Mail::send('emails.new_article', ['user' => $user, 'article' => $article], function ($m) use ($user) {
            //         $m->from('you@domain.com', 'Friendly Name');
            //         $m->to($user->email, $user->name)->subject('New Article Posted');
            //   });

            Mail::send('mails.bid_cancelled', ['msg' => $bid], function($m) use ($bid){
                $m->from('info@luefty.com', 'Luefty');
                $m->to($bid->user->email, $bid->user->name)->subject(__('Bid Cancelled'));
            });
        }


    }
}
