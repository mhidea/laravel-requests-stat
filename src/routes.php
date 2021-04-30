<?php

Route::prefix(config('laravel-requests-stat.path'))->name("laravelRequestsStat.")
    ->namespace('Mhidea\LaravelRequestsStat\controller')->group(function () {
        Route::get('/', "LaravelRequestsStatController@index")->name("index");
        Route::get('/reset/{id}', "LaravelRequestsStatController@reset")->name("reset");
        Route::get('/resetall', "LaravelRequestsStatController@resetall")->name("resetall");
    });
