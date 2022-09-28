<?php

namespace App\Listeners;

use App\Events\BidAcceptedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SupplierBidAcceptedNotification implements ShouldQueue
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
     * @param  BidAcceptedNotification  $event
     * @return void
     */
    public function handle(BidAcceptedNotification $event)
    {
        $bid = $event->bid;

        Mail::send('bookings.mails.bid_accepted', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->user->email, $bid->user->name)->subject(__('Your bid was accepted!'));
        });
    }
}
