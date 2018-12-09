<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;
use Imagick;

class RotateController extends Controller
{
    // public function show()
    // {
        
    // }

    // public function edit(int $id)
    // {
    // 	try {
    //   		$model = History::findOrFail($id);
    // 	} catch (\Exception $err) {
    //   		logger($err->getMessage());

    //   	return response()->json([
    //     	'status'=> false,
    //     	'message' => $err->getMessage(),
    //     	'model'=>null], 422);
    // 	}

    public function edit() {
		    $imagick = new Imagick (realpath('D:\OSPanel\domains\PS\storage\app\Photos\1.JPG'));
		    
		    $imagick->rotateimage('black', 90);

		    

		    $model = new History;
	    try {
	      	$model = $model->fill([
	        'edit_history'=> '1',
	        'result_file_path'=> '1'
	      	]);
	      	$model->save();
	    } catch (\Exception $err) {
	      	logger($err->getMessage());

	    return response()->json([
	        'status'=> false,
	        'message' => $err->getMessage(),
	        'model'=>null], 422);
	    }
	    return response()->json([
		    'status'=>true,
		    'message'=>('upload success'),
		    'model'=>$model], 200);
		    //var_dump($imagick);
    	//print_r('111111');
		}

    	// $imagick = new Imagick('photos/profile-photo-1544174453.JPG');
    	// var_dump($model);

    	// return response()->json([
     //  		'status'=>true,
     //  		'model'=>$model,], 200);
    //}
  
    // public function delete()
    // {
        
    // }
}
