<?php namespace itway\Http\Middleware;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Cookie;
use \Illuminate\Http\Request;
use Closure;
use Config, App, Redirect; // ... and so on
use Auth;
use itway\User;
class LocalUser {

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function handle(Request $request, Closure $next)
//    {
//        Lang::setLocale($request->cookie('locale'));
//        return $next($request);
//    }
    public function handle(Request $request, Closure $next)
    {
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if (!$locale && $request->cookie('locale')) {

            return redirect()->to( '/'.$request->cookie('locale'));

        }
        if ( ! array_key_exists($locale, Config::get('app.locales'))) {

            $segments = $request->segments();
            $segments[0] = Config::get('app.fallback_locale');
            $newUrl = implode('/', $segments);
//            if (array_key_exists('QUERY_STRING', $_SERVER))
//                $newUrl .= '?'.$_SERVER['QUERY_STRING'];
//            return redirect()->to($newUrl);

          return redirect()->to($newUrl);
        }

        App::setLocale($locale);

        return $next($request);

    }

}
