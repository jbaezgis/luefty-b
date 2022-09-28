<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToDavid implements ShouldQueue
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
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        $message = $event->message;

        // dd($bid->user->email, $bid->user->name);

        Mail::send('mails.messagetodavid', ['msg' => $message], function($m) use ($message){
            $m->from('info@luefty.com', 'Luefty');
            $m->to(('jbaezgis@gmail.com'), ('David'))->subject(__('New message from Luefty!'));
        });
    }
}
