<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Model\History;


class GlobalService
{
	static function fileStore ($path, $edit_history)
	{
		$model = new History;
	    try {
	      	$model = $model->fill([
	        'edit_history'=> $edit_history,
	        'result_file_path'=> $path
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
	}
}