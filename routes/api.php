<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Api App's Routes
|--------------------------------------------------------------------------
|
| This is the Api app's routes
|
*/

$router->get('/api',function(){
    echo 'api!';
});

$router->group(['middleware' => 'guest'], function (Router $router) {

    $router->get('/api/login', function () {
        $_SESSION['user'] = true;

        return 'Success auth! <a href="/">Return home</a>';
    });

});

$router->group(['middleware' => 'auth'], function (Router $router) {

    $router->get('/api/omar', function () {
        return 'hello world!';
    });

    $router->get('/api/logout', function () {
        unset($_SESSION['user']);

        return 'Success logout! <a href="/">Return home</a>';
    });

});
