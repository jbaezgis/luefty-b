<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\AuctionWon' => [
            'App\Listeners\SendToBidder',
            'App\Listeners\SendToAuctioneer',
        ],

        'App\Events\AuctionBidAccepted' => [
            'App\Listeners\AceptedBidNotification',
            'App\Listeners\AceptedBidForAuctioneer',
        ],

        'App\Events\AuctionBidCancelled' => [
            'App\Listeners\CancelledBidNotification',
            // 'App\Listeners\AceptedBidForAuctioneer',
        ],

        'App\Events\MessageWasReceived' => [
            'App\Listeners\SendToDavid',
        ],

        'App\Events\BookingNotification' => [
            'App\Listeners\SendTouristNotification',
            'App\Listeners\SendAgentNotification',
        ],

        'App\Events\AuctionNotification' => [
            'App\Listeners\SendTouristAuctionNotification',
            'App\Listeners\SendAgentAuctionNotification',
        ],

        'App\Events\BookingConfirmation' => [
            'App\Listeners\SendTouristConfirmation',
            'App\Listeners\SendAgentConfirmation',
        ],

        'App\Events\NewBidNotification' => [
            'App\Listeners\NewBidTouristNotification',
            // 'App\Listeners\NewBidAuctioneerNotification',
            // 'App\Listeners\NewBidToLueftyNotification',
        ],

        'App\Events\BidAcceptedNotification' => [
            'App\Listeners\SupplierBidAcceptedNotification',
        ],

        'App\Events\PaymentAcceptedNotification' => [
            'App\Listeners\TouristPaymentAcceptedNotification',
            'App\Listeners\AgentPaymentAcceptedNotification',
        ],

        'App\Events\NewAuctionNotification' => [
            'App\Listeners\NewAuctionB2BNotification',
        ],
        
        'App\Events\NewAuctionB2CNotification' => [
            'App\Listeners\NewAuctionTouristNotification',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
