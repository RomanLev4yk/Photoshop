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

	Route::prefix('/image')
		->group(function () {
			Route::get('/{id}', 'ImageController@showImage');
		    Route::post('/', 'ImageController@storeImage');
		    Route::delete('/{id}', 'ImageController@deleteImage');
	}); 

	Route::prefix('/rotate')
		->group(function () {
		    Route::post('/', 'RotateController@rotateImage');
	}); 
	Route::prefix('/crop')
		->group(function () {
		    Route::post('/', 'CropController@cropImage');
	}); 
	Route::prefix('/border')
		->group(function () {
		    Route::post('/', 'BorderController@borderImage');
	}); 
	Route::prefix('/flop')
		->group(function () {
		    Route::post('/', 'FlopController@flopImage');
	}); 
	Route::prefix('/filter')
		->group(function () {
		    Route::post('/', 'FilterController@filterImage');
	}); 
	