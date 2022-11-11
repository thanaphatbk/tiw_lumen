<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/d', function () use ($router) {
    $data = [
        "data" => "hello",
        "Status" => "OK",
    ];
    return response()->json($data);
});

$router->get('/getAllbySQL', function () use ($router) {
    $data = DB::select("SELECT * FROM users");
    return response()->json($data);
});



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/getAllUserbyController', 'UsersController@getAllUserbyController');
    $router->get('/getAllUserbyModels', 'UsersController@getAllUserbyModels');
    $router->post('addNewUser', 'UsersController@addNewUser');
    $router->put('update_name/{id}', ['uses' => 'UsersController@update_name']);
    $router->delete('delete_user/{id}', ['uses' => 'UsersController@delete_by_id']);
    
});
