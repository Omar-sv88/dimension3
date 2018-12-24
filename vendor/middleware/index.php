<?php

/**
 * Illuminate/Routing
 *
 * @source https://github.com/illuminate/routing
 * @contributor https://github.com/dead23angel
 * @contributor Matt Stauffer
 */

// require_once 'vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;

// Create new IoC Container instance
$container = new Container;

// Using Illuminate/Events/Dispatcher here (not required); any implementation of
// Illuminate/Contracts/Event/Dispatcher is acceptable
$events = new Dispatcher($container);

// Create the router instance
$router = new Router($events);

// Global middlewares
$globalMiddleware = [
    \App\Middleware\StartSession::class,
];

// Array middlewares
$routeMiddleware = [
    'auth' => \App\Middleware\Authenticate::class,
    'guest' => \App\Middleware\RedirectIfAuthenticated::class,
];

// Load middlewares to router
foreach ($routeMiddleware as $key => $middleware) {
    $router->aliasMiddleware($key, $middleware);
}
