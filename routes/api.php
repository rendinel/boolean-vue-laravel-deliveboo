<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('plates', 'Api\PlateController@index');

Route::get('restaurants', 'Api\RestaurantController@index');

Route::get('restaurants/search', 'Api\RestaurantController@search');

Route::get('orders', 'Api\OrderController@index');

Route::get('categories', 'Api\CategoryController@index');