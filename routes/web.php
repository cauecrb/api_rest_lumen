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

$router->get('/', function () use ($router){
    return $router->app->version();
});

/**
 * rotas para acessar as ordens de serviço
 */

$router->get('/listall', 'service_ordersController@userIdToName');
$router->get('/orders/{vehiclePlate}', 'service_ordersController@show');
$router->post('/new', 'service_ordersController@new');
$router->post('/newuser', 'service_ordersController@create');
//$router->put('/orders/{id}', 'Service_ordersController@update');
//$router->delete('/orders/{id}', 'Service_ordersController@delete');

