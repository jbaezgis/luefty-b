<?php

namespace App\Listeners;

use App\Events\BookingNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SendAgentNotification implements ShouldQueue
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
