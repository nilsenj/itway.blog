<?php

namespace itway\Handlers\Events;

use itway\Events\PostWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserOfHisNewPost
{
    /**
     * Create the event handler.
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
     * @param  PostWasCreatedEvent  $event
     * @return void
     */
    public function handle(PostWasCreatedEvent $event)
    {
        //
    }
}
