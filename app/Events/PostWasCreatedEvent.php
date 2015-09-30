<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use itway\Post;
use itway\User;

class PostWasCreatedEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $post;

    public $user;

    /**
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {

        $this->post = $post;
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['post-created'];
    }
}
