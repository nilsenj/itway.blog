<?php

namespace Nilsenj\Profiler;

use Closure;
use Nilsenj\Profiler\Facades\Profiler as nProfiler;

class ProfilerLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        nProfiler::start();

        $response = $next($request);

        nProfiler::stop();

        return $response;



    }
}
