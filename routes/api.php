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

	Route::prefix('/store')
		->group(function () {
			Route::get('/{id}', 'StoreController@show');
		    Route::post('/', 'StoreController@store');
		    Route::delete('/{id}', 'StoreController@delete');
	}); 

	Route::prefix('/rotate')
		->group(function () {
		    Route::get('/', 'RotateController@edit');
	}); 
	Route::prefix('/crop')
		->group(function () {
		    Route::get('/', 'CropController@edit');
	}); 
	Route::prefix('/border')
		->group(function () {
		    Route::get('/', 'BorderController@edit');
	}); 
	Route::prefix('/flop')
		->group(function () {
		    Route::get('/', 'FlopController@edit');
	}); 
	Route::prefix('/filter')
		->group(function () {
		    Route::get('/', 'FilterController@edit');
	}); 
	