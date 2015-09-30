<?php

namespace itway\Handlers\Events;

use itway\Events\UserWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class EmailUserOfThatWasCreated
{
//    /**
//     * Create the event handler.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreatedEvent  $event
     * @return void
     */
    public function handle(UserWasCreatedEvent $event)
    {
        dd($event);
        Mail::queue('emails.welcome', function($message)
        {
            $message->to('foo@example.com', 'John Smith')->subject('Welcome!');
        });
    }
}
