<?php

namespace itway\Handlers\Commands;

use itway\Commands\CreateUserCommand;
use itway\Events\UserWasCreatedEvent;
use itway\User;
use Illuminate\Queue\InteractsWithQueue;
use Event;

class CreateUserCommandHandler
{
//    /**
//     * Create the command handler.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }

    /**
     * @param CreateUserCommand $command
     * @return static
     */
    public function handle(CreateUserCommand $command)

    {
        $user =  User::create([
            'name' => $command->name,
            'email' => $command->email,
            'photo' => $command->photo,
            'provider' => $command->provider,
            'provider_id' => $command->provider_id
        ]);

        Event::fire(new UserWasCreatedEvent($user));

        return $user;
    }
}
