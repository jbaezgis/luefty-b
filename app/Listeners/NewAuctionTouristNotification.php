<?php

namespace App\Listeners;

use App\Events\NewAuctionB2CNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAuctionTouristNotification
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
     * @param  NewAuctionB2CNotification  $event
     * @return void
     */
    public function handle(NewAuctionB2CNotification $event)
    {
        //
    }
}
