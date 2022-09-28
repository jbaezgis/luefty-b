<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBidToAuctioneer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'You have New bid!';

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
        return $this->view('mails.b2b.new_bid_to_auctioneer')->with(['bid' => $this->bid]);
    }
}
