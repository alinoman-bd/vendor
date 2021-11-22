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

Route::group(["namespace" => "Api"], function () {
    Route::post('login', 'AuthController@login')->name('api.login');
    Route::post('register', 'AuthController@register');
    Route::get('locations', 'LocationController@index');
    Route::get('locations/{location}', 'LocationController@location');
    Route::get('cities', 'LocationController@city');
    Route::get('cities/{city}', 'LocationController@cityShow');
    Route::get('facilities', 'LocationController@facilities');
    Route::get('facilities/{facility}', 'LocationController@facility');
    Route::get('types', 'LocationController@types');
    Route::get('seas', 'LocationController@seas');
    Route::get('lakes', 'LocationController@allLakes');
    Route::get('price-types', 'LocationController@priceTypes');
    Route::get('payment-types', 'LocationController@paymentTypes');
    Route::get('seasons', 'LocationController@seasons');
    Route::get('lakes/{lake}', 'LocationController@oneLake');
    Route::get('rivers', 'LocationController@allRivers');
    Route::get('rivers/{river}', 'LocationController@oneRiver');
    Route::get('locations/{location}/lakes', 'LocationController@lakes');
    Route::get('locations/{location}/rivers', 'LocationController@rivers');
    Route::get('resources/{p1?}/{p2?}/{p3?}', 'IndexController@index')->name('api.resource.all');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logoutOnly');
        Route::get('logout/all', 'AuthController@logoutAll');
        Route::get('users/{user}', 'AuthController@show');
        Route::post('resources', 'ResourceController@store');
    });
    Route::post('{any}', 'AnyController@postAny')->name('api.anypost');
    Route::get('{any}', 'AnyController@getAny')->name('api.anyget');
});