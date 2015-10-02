<?php namespace itway\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use itway\Post;
use View;
use itway\SidebarCreator;
use Auth;
use App;
use Event;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
//        Blade::setEchoFormat('e(utf8_encode(%s))');

			View::creator(
			'sidebar.sidebar',
			SidebarCreator::class
		);

		Event::listen('nilsenj.profiler', 'Nilsenj\Profiler\Profiler@handle');

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'itway\Services\Registrar'
		);
		$this->app->bind(
			'Itway\Repositories\Auth\UserContract',
			'Itway\Repositories\Auth\EloquentUserRepository'
		);
		$this->app->bind(
			'Itway\Repositories\Posts\PostsRepository',
			'Itway\Repositories\Posts\EloquentPostsRepository'
		);

		$this->app->bind(
			'Itway\Repositories\Roles\RolesRepository',
			'Itway\Repositories\Roles\EloquentRolesRepository'
		);
		$this->app->bind(
			'Itway\Repositories\Permissions\PermissionRepository',
			'Itway\Repositories\Permissions\EloquentPermissionRepository'
		);
		$this->app->bind(
			'Itway\Repositories\Users\UserRepository',
			'Itway\Repositories\Users\EloquentUserRepository'
		);

        $this->app->bind(
            'Itway\Contracts\Likeable\Likeable');

	}


}
