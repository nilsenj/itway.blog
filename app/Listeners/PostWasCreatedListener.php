<?php

namespace itway\Listeners;

use itway\Events\PostWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\MailComposers\PostCreatedMailComposer;
use itway\Post;
use App;
use itway\User;

class PostWasCreatedListener
{
    /**
     * @param PostCreatedMailComposer $mailer
     */
    public function __construct(PostCreatedMailComposer $mailer)
    {
        $this-> mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  PostWasCreatedEvent  $event
     * @return void
     */
    public function handle(PostWasCreatedEvent $event)
    {
        $post = Post::find($event->post->id);

        $title = $post->title;

        $link = App::getLocale().'/blog/post/'.$post->id;

        $user = User::find($event->user->id);

        $username = $user->name;

        $this->mailer->compose($user->email, $username, $title, $link)->send();

    }
}
