<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/26/2015
 * Time: 7:23 PM
 */

namespace itway\Commands;

use itway\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\UserWasCreatedEvent;
use itway\User;
class CreateUserCommand  extends Command implements SelfHandling
{
    public $name,
        $email,
        $photo,
        $provider,
        $provider_id;


    /**
     * @param $name
     * @param $email
     * @param $photo
     * @param $provider
     * @param $provider_id
     */
    public function __construct(
        $name,
        $email,
        $photo,
        $provider,
        $provider_id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->photo = $photo;
        $this->provider = $provider;
        $this->provider_id = $provider_id;
    }


    public function handle()

    {
        $user =  User::create([
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id

        ]);

        event(new UserWasCreatedEvent($user));

        return $user;
    }

}