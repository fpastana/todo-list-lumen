<?php

use Illuminate\Http\Request;

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

// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function() use ($router){
    $router->group(['prefix' => 'users'], function() use ($router){
        $router->get('/', [
            'as' => 'user_index',
            'uses' => 'api\UserController@index'
        ]);
        $router->post('/', [
            'as' => 'user_store',
            'uses' => 'api\UserController@store'
        ]);
        $router->get('/{id}', [
            'as' => 'user_show',
            'uses' => 'api\UserController@show'
        ]);
        $router->put('/{id}', [
            'as' => 'user_update',
            'uses' => 'api\UserController@update'
        ]);
        $router->delete('/{id}', [
            'as' => 'user_delete',
            'uses' => 'api\UserController@destroy'
        ]);
    });

    $router->group(['prefix' => 'todo-notes'], function() use($router){
        $router->get('/', [
            'uses' => 'api\TodoNoteController@index'
        ]);
        $router->get('/user/{user_id}', [
            'uses' => 'api\TodoNoteController@indexUser'
        ]);
        $router->post('/', [
            'uses' => 'api\TodoNoteController@store'
        ]);
        $router->delete('/{id}', [
            'uses' => 'api\TodoNoteController@destroy'
        ]);
        $router->patch('/mark-as-complete/{id}', [
            'uses' => 'api\TodoNoteController@markAsComplete'
        ]);
        $router->patch('/mark-as-incomplete/{id}', [
            'uses' => 'api\TodoNoteController@markAsIncomplete'
        ]);
    });
});
