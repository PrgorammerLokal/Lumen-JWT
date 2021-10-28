<?php

use Illuminate\Support\Str;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return Str::random(32);
});

// router users
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');
    $router->get('user/{id}', ['middleware' => 'auth:api', 'uses' => 'UserController@show']);
    $router->put('user/profile/{id}', ['middleware' => 'auth:api', 'uses' => 'UserController@profile']);
});
