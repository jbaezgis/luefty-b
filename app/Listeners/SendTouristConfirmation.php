<?php

namespace App\Listeners;

use App\Events\BookingConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Mailable;
use Mail;

class SendTouristConfirmation implements ShouldQueue
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
     * @param  BookingConfirmation  $event
     * @return void
     */
    public function handle(BookingConfirmation $event)
    {
        $bid = $event->bid;

        // dd($auction->user->email, $auction->user->name);

        Mail::send('bookings.mails.booking_confirmation', ['msg' => $bid], function($m) use ($bid){
            $m->from('info@luefty.com', 'Luefty');
            $m->to($bid->auction->email, $bid->auction->full_name)->subject(__('Booking Confirmation!'));
        });
    }
}
