<?php

namespace itway\Http\Controllers\Auth;


use itway\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Validator;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Itway\Repositories\Auth\UserContract;


class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';



	/**
	 * @var Socialite
	 */
	private $socialite;
	/**
	 * @var Guard
	 */
	private $auth;
	/**
	 * @var UserContract
	 */
	private $users;
	/**
	 * @param Socialite $socialite
	 * @param Guard $auth
	 * @param UserContract $users
	 */
	public function __construct(Socialite $socialite, Guard $auth, UserContract $users) {
		$this->socialite = $socialite;
		$this->users = $users;
		$this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
	}


	public function validator(array $data)
	{
		return \Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'photo' => 'min:6|unique:users|url',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */


	public function create(array $data)
	{
        return $this->users->create($data);
	}

	/**
	 * @param $request
	 * @param $provider
	 * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function loginVendorProviders($request, $provider) {

		if (! $request) {

			return $this->getAuthorizationFirst($provider);
		}

		$user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);

		$this->auth->login($user, true);

		return redirect('/');
	}

	/**
	 *
	 * @param $provider
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	private function getAuthorizationFirst($provider) {

		return $this->socialite->driver($provider)->redirect();
	}
	/**
	 * @param $provider
	 * @return \Laravel\Socialite\Contracts\User
	 */
	private function getSocialUser($provider) {

		return $this->socialite->driver($provider)->user();

	}
    /**
     * @param Request $request
     * @param $provider
     * @return mixed
     */
    public function loginThirdParty(Request $request, $provider) {

        return $this->loginVendorProviders($request->all(), $provider);
    }

}
