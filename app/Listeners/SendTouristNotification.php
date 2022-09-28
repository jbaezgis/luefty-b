<?php

namespace App\Listeners;

use App\Events\BookingNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTouristNotification
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
     * @param  BookingNotification  $event
     * @return void
     */
    public function handle(BookingNotification $event)
    {
        //
    }
}
