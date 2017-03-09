<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => ['api']], function () {

    Route::any('/Book.getList', 'Api\BookApiController@getList');
    Route::any('/Book.getById', 'Api\BookApiController@getById');
    Route::any('/Book.add', 'Api\BookApiController@add');
    Route::any('/Book.remove', 'Api\BookApiController@remove');
    Route::any('/Book.edit', 'Api\BookApiController@edit');

});

