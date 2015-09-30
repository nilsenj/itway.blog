<?php namespace Itway\Services\Youtube;


use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class YoutubeServiceProvider extends ServiceProvider {

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
        $loader->alias('Youtube', 'Itway\Services\Youtube\Facades\Youtube');
        $this->publishes([
            __DIR__ . '/config/youtube.php' => config_path('youtube.php'),
        ], 'config');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

            $this->app->bindShared('youtube', function($app)
            {
                $key = \Config::get('Itway/Services/Youtube::KEY');
                return new Youtube($key);
            });

        $this->app->bindShared('youtube', function()
        {
                return $this->app->make('Itway\Services\Youtube\Youtube', [config('youtube.KEY')]);

        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('youtube');
	}



}
