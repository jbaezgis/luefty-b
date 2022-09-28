<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuctionChangedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'This Auction Was Edited!';

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
        return $this->view('mails.b2b.auction_changed')->with(['auction' => $this->auction]);
    }
}
