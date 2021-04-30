<?php return [

    /*
    |--------------------------------------------------------------------------
    | LaravelRequestsStat Path
    |--------------------------------------------------------------------------
    |
    | URI path where LaravelRequestsStat will be served. Feel free to change it.
    |
    */

    'path' => env('LaravelRequestsStat_PATH', 'requestsStat'),

    /*
    |--------------------------------------------------------------------------
    | Name of middleware
    |--------------------------------------------------------------------------
    |
    | This is the name of the middleware to be applied to above path.  
    |
    */

    'middleware' => ['web'],
];
