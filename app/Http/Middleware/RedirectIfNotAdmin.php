<?php namespace itway\Http\Middleware;

use Closure;

class RedirectIfNotAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
    {
        if (\Auth::user()) {

            if ($request->user()->hasRole('Admin') || $request->user()->hasRole('Manager')) {

                return $next($request);

            }
            return redirect("/");

        }
	}

}
