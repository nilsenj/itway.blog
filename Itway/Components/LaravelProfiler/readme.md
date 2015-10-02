# Timbre Profiler

Timbre Profiler is a URL profiler for Laravel 4.


## Installation

`composer.json` file:

```json
{
    "require": {
        "nilsenj/profiler": "0.*"
    }
}
```

config file `app/config/app.php`

```php
'Nilsenj\Profiler\ProfilerServiceProvider',
```

```php
'Profiler' => 'Nilsenj\Profiler\Facades\Profiler',
```

## Configuration

```
php artisan migrate --package=nilsenj/profiler
php artisan config:publish nilsenj/profiler
php artisan asset:publish nilsenj/profiler
```


`app/start/global.php`
```php 
App::before(function($request)
{
	Profiler::start();
});

App::after(function($request, $response)
{
    Profiler::stop();
});

Event::listen('timbre.profiler', 'Timbre\Profiler\Profiler@handle');
```

`app/controllers/BaseController.php`
```php
public function __construct()
{
	Event::fire('timbre.profiler', $this);
}
```


## Screenshots

![alt text](http://oi60.tinypic.com/o9im54.jpg "Screenshot")

![alt text](http://oi62.tinypic.com/iz7ujl.jpg "Screenshot")