<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../laravel_data/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
// require __DIR__.'/../laravel_data/vendor/autoload.php';
require __DIR__.'/../vendor/autoload.php';
// Bootstrap Laravel and handle the request...
// (require_once __DIR__.'/../laravel_data/bootstrap/app.php')
//     ->handleRequest(Request::capture());
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
