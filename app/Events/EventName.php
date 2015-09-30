<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventName extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $data;

    /**
     *
     */
    public function __construct()
    {
        $this->data = array(
            'power'=> '10'
        );
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['test-channel'];
    }
}
