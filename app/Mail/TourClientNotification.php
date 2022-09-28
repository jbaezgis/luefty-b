<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TourClientNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Booking Details!';

    protected $booking; 

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.tour.client_notification')->with(['booking' => $this->booking]);
    }
}
