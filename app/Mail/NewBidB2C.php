<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBidB2C extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'New bid!';

    protected $bid; 

    public function __construct($bid)
    {
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.b2c.new_bid')->with(['bid' => $this->bid]);
    }
}
