<?php

namespace Mhidea\LaravelRequestsStat;

use App\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Route;

/**
 * undocumented class
 */
class LaravelRequestsStatServiceProvider  extends ServiceProvider
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function register()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-requests-stat.php',
            'laravel-requests-stat'
        );

        return true;
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function boot()
    {
        Route::pushMiddlewareToGroup('api', StatMiddleware::class);
        Route::pushMiddlewareToGroup('web', StatMiddleware::class);

        $this->loadMigrationsFrom(__DIR__);


        $this->loadViewsFrom(__DIR__ . '/views', 'LaravelRequestsStat');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/config/laravel-requests-stat.php' => config_path('laravel-requests-stat.php')
        ], 'laravelRequestsStat-config');
    }
}
