<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptedBidNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $m;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(M $m)
    {
        $this->m = $m;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.bidder');
    }
}
