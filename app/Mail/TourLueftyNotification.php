<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TourLueftyNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'New Tour Reservation!';

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
        return $this->view('mails.tour.new_reservation')->with(['booking' => $this->booking]);
    }
}
