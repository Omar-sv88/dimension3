<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| App's Routes
|--------------------------------------------------------------------------
|
| This is the app's routes
|
*/

// $router->get('/',function(){
//     return View::CreateView('home');
// });

$router->get('/','HomeController@omar');
