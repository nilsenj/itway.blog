<?php namespace Itway\Repositories\Auth;

use itway\Commands\CreateUserCommand;
use itway\User;
use Illuminate\Contracts\Bus\Dispatcher;
/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentUserRepository implements UserContract {

    public $dispatcher;
    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher){
        $this->dispatcher = $dispatcher;
    }
    /**
     * @param $data
     * @return static
     */
    public function create($data) {

        return    $this->dispatchUser($data);

    }
    /**
     * in case Socail Auth or simple login
     * @param $data
     * @param $provider
     * @return static
     */

    public function findByUserNameOrCreate($data, $provider)
    {

        $user = User::where('provider_id', '=', $data->id )->orWhere('email', '=', $data->email )->first();

        if (!$user) {
            $this->dispatchUser($data, $provider, $data['photo'], $data['id']);
        }

            $this->checkIfUserNeedsUpdating($data, $user, $provider);
            return $user;

    }

    /**
     *  dispatch command and binded event to create a new user
     *
     * @param $data
     * @param null $provider
     * @param null $photo
     * @param null $id
     * @return mixed
     */
    protected function dispatchUser($data, $provider = null, $photo = null, $id = null){
       $user =  $this->dispatcher->dispatch(
            new CreateUserCommand(
                $data['name'],
                $data['email'],
                $photo,
                $provider,
                $id

            ));
        return $user;
    }


    /**
     *      just check what changes appeared in login and update users data
     *
     * @param $data
     * @param $user
     * @param $provider
     */
    public function checkIfUserNeedsUpdating($data, $user, $provider) {
        $socialData = [
            'photo' => $data->avatar,
            'email' => $data->email,
            'name' => $data->name,
            'provider' => $provider,
            'provider_id' => $data->id,

        ];
        $dbData = [
            'photo' => $user->photo,
            'email' => $user->email,
            'name' => $user->name,
            'provider' => $user->provider,
            'provider_id' => $user->provider_id,
        ];

        $differences = array_diff($socialData, $dbData);
        if (! empty($differences)) {
            $user->photo = $data->avatar;
            $user->email = $data->email;
            $user->name = $data->name;
//            $user->password = $user->password;
            $user->provider = $provider;
            $user->provider_id = $data->id;
            $user->update();
        }
    }

}