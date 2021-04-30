# Laravel Requests Stat
Lightweight package to save requests' statistic that helps you find problematic routes to be optimized.
## Installation
Install using composer:
```bash
composer require mhidea/laravel-requests-stat
```
Add serviceproviver to 'providers' in config/app.php:
```bash
Mhidea\LaravelRequestsStat\LaravelRequestsStatServiceProvider::class
```
Migrate:
```bash
php artisan migrate
```
Publish config file to config/laravel-requests-stat.php:
```bash
php artisan vendor:publish --tag=laravelRequestsStat-config
```

Then you can see stats in path /requestsStat. This path can be changed in config file.

