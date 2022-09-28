<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAuctionB2B extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'New Auction Created!';

    protected $auction; 

    public function __construct($auction)
    {
        $this->auction = $auction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.b2b.new_auction')->with(['auction' => $this->auction]);
    }
}
