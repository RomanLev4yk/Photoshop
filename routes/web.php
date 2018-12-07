<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('process', function (Request $request) {
    try{
    	$validation = $request->validate([
        'photo' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);
    }
    catch (\Exception $err) {
        logger($err->getMessage());

        return response()->json([
          'status'=> false,
          'message' => $err->getMessage()]);
    }	
    $file      = $validation['photo']; // get the validated file
    $extension = $file->getClientOriginalExtension();
    $filename  = 'profile-photo-' . time() . '.' . $extension;
    $path      = $file->storeAs('photos', $filename);

    return response()->json([
        'status'=>true,
        'message'=>('upload success')]);

    dd($path);
});