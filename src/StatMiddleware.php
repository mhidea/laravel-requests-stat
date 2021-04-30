<?php

namespace Mhidea\LaravelRequestsStat;

use Mhidea\LaravelRequestsStat\MhRequestsStat;
use Closure;

class StatMiddleware
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
        return $next($request);
    }



    public function terminate($request, $response)
    {

        $duration = microtime(true) - LARAVEL_START;
        $stat = MhRequestsStat::firstOrNew(['path' => $request->path()]);
        $stat->sum += $duration;
        $stat->count += 1;
        $stat->save();
    }
}
