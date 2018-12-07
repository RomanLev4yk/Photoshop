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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

	Route::prefix('/store') // storeimage
		->group(function () {
		    Route::post('/', 'StoreController@store');
		    Route::delete('/{id}', 'StoreController@delete');
	}); 

	Route::prefix('/rotate') // rotateimage
		->group(function () {
		    Route::get('/{id}', 'RotateController@show');
		    Route::post('/', 'RotateController@edit');
		    Route::delete('/{id}', 'RotateController@delete');
	}); 
	Route::prefix('/crop') //cropimage
		->group(function () {
		    Route::get('/{id}', 'CropController@show');
		    Route::post('/', 'CropController@edit');
		    Route::delete('/{id}', 'CropController@delete');
	}); 
	Route::prefix('/border')  //borderimage
		->group(function () {
		    Route::get('/{id}', 'BorderController@show');
		    Route::post('/', 'BorderController@edit');
		    Route::delete('/{id}', 'BorderController@delete');
	}); 
	Route::prefix('/flop') //flopimage  отражение слева направо
		->group(function () {
		    Route::get('/{id}', 'FlopController@show');
		    Route::post('/', 'FlopController@edit');
		    Route::delete('/{id}', 'FlopController@delete');
	}); 
	Route::prefix('/filter') //filter
		->group(function () {
		    Route::get('/{id}', 'FilterController@show');
		    Route::post('/', 'FilterController@edit');
		    Route::delete('/{id}', 'FilterController@delete');
	}); 
	