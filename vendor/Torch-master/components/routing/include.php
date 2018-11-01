<?php 

use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;

// Load the routes
// require_once 'routes.php';

// Create the redirect instance
$redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));

// use redirect
// return $redirect->home();
// return $redirect->back();
// return $redirect->to('/');

// Dispatch the request through the router
$response = $router->dispatch($request);

// Send the response back to the browser
$response->send();