<?php

namespace App\Listeners;

use App\Events\PaymentAcceptedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TouristPaymentAcceptedNotification
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
     * @param  PaymentAcceptedNotification  $event
     * @return void
     */
    public function handle(PaymentAcceptedNotification $event)
    {
        //
    }
}
