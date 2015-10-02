<?php namespace Nilsenj\Profiler;

use Illuminate\Support\ServiceProvider;

class ProfilerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('Profiler', 'Nilsenj\Profiler\Facades\Profiler');

		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('profiler.php'),
		], 'config');

		if (! $this->app->routesAreCached()) {
			require __DIR__.'/../../routes.php';
		}

		$this->loadViewsFrom(__DIR__.'/../../views', 'profiler');

		$this->publishes([
			__DIR__.'/../../views' => base_path('resources/views/vendor/profiler'),
		]);

		$this->publishes([
			__DIR__.'/../../../public/assets' => public_path('vendor/profiler'),
		], 'public');

		$this->publishes([
			__DIR__.'/../../migrations/' => database_path('migrations')
		], 'migrations');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $this->app->bindShared('nilsenj.profiler', function($app)
        {
        	return new Profiler($app['session'], $app['config']);
        });	
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['nilsenj.profiler'];
	}

}
