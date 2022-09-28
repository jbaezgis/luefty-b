<?php

namespace App\Listeners;

use App\Events\NewBidNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBidToLueftyNotification
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
        //
    }
}
