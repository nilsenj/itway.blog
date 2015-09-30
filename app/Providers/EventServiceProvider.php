<?php namespace itway\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use itway\Events\UserWasCreatedEvent;
use itway\Events\PostWasCreatedEvent;
use itway\Listeners\PostWasCreatedListener;
use itway\Listeners\UserRegisteredListener;


class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
		UserWasCreatedEvent::class => [
			UserRegisteredListener::class
		]
		,
		PostWasCreatedEvent::class => [
			PostWasCreatedListener::class
		]

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
