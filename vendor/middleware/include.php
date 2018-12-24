<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;

// Load the routes
// require_once 'routes.php';

// Create a request from server variables
$request = Request::capture();

// Dispatching the request:
// When it comes to dispatching the request, you have two options:
// a) you either send the request directly through the router
// or b) you pass the request object through a stack of (global) middlewares
// then dispatch it.

// a. Dispatch the request through the router
// $response = $router->dispatch($request);

// b. Pass the request through the global middlewares pipeline then dispatch it through the router
$response = (new Pipeline($container))
    ->send($request)
    ->through($globalMiddleware)
    ->then(function ($request) use ($router) {
        return $router->dispatch($request);
    });

// Send the response back to the browser
$response->send();
