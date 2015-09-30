<?php

namespace itway\Listeners;

use itway\Events\UserWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\MailComposers\WelcomeMailComposer;
use itway\User;

class UserRegisteredListener
{
    /**
     * @param WelcomeMailComposer $mailer
     */
    public function __construct(WelcomeMailComposer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreatedEvent  $event
     * @return void
     */
    public function handle(UserWasCreatedEvent $event)
    {

        $user = User::find($event->user->id);

        $this->mailer->compose($user->email, $user->name)->send();
    }
}
