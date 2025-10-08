<?php

// -----------------------------------------------------------
// 1. Start measuring the time Laravel takes to handle request
// -----------------------------------------------------------
define('LARAVEL_START', microtime(true));

// -----------------------------------------------------------
// 2. Check if the application is in maintenance mode
// If yes, load the maintenance file and show maintenance page
// (This happens if you run "php artisan down")
// -----------------------------------------------------------
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// -----------------------------------------------------------
// 3. Register Composer Autoloader
// Composer autoloading automatically loads classes (models,
// controllers, libraries) without requiring manual includes.
// -----------------------------------------------------------
require __DIR__.'/../vendor/autoload.php';

// -----------------------------------------------------------
// 4. Bootstrap Laravel and create an Application instance
// This sets up the service container and important components.
// -----------------------------------------------------------
/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// -----------------------------------------------------------
// 5. Create an instance of the HTTP Kernel
// The HTTP Kernel is responsible for handling incoming requests
// and sending responses back to the browser.
// -----------------------------------------------------------
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// -----------------------------------------------------------
// 6. Capture the current HTTP request and send it through
// the Laravel application to get the response back.
// -----------------------------------------------------------
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

// -----------------------------------------------------------
// 7. Terminate the request
// This allows Laravel to perform cleanup tasks, run any
// terminate middleware, and log data before finishing.
// -----------------------------------------------------------
$kernel->terminate($request, $response);