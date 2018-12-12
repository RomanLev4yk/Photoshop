<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;
use Imagick;

class FilterController extends Controller
{
    public function edit(Request $request) {

    	$params = [
         	'id'=>$request->input('id'),
         	'radius' =>$request->input('radius'),
         	'sigma' =>$request->input('sigma')];
    	$edit_file = History::findOrFail($params['id']);
    	$realpath = realpath('D:\OSPanel\domains\PS\storage\app\\' . $edit_file["result_file_path"]);
		$imagick = new Imagick ($realpath);
		try{
			$imagick->charcoalImage($params['radius'], $params['sigma']);
		}
		catch (\Exception $err) {
	      	logger($err->getMessage());

	      	return response()->json([
	        'status'=> false,
	        'message' => $err->getMessage(),
	        'model'=>null], 422);
	    }

		$extension = explode(".", $realpath);
	    $filename = 'edited-photo-' . time() . '.' . $extension[1];
	    file_put_contents( 'D:\OSPanel\domains\PS\storage\app\photos\\' . $filename, $imagick);
	    $path = 'photos/' . $filename;
	    $edit_history = 'image filter';
	    
		return GlobalService::fileStore($path, $edit_history);
	}
}
