<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;

class StoreController extends Controller
{
	public function store(Request $request)
    {
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
	    $file = $validation['photo'];
	    $extension = $file->getClientOriginalExtension();
	    $filename = 'profile-photo-' . time() . '.' . $extension;
	    $path = $file->storeAs('photos', $filename);
	    $edit_history = 'file store';

	    $globalService = new GlobalService();
		return $globalService->fileStore($path, $edit_history);

	    // $model = new History;
	    // try {
	    //   	$model = $model->fill([
	    //     'edit_history'=> 'file store',
	    //     'result_file_path'=> $path
	    //   	]);
	    //   	$model->save();
	    // } catch (\Exception $err) {
	    //   	logger($err->getMessage());

	    // return response()->json([
	    //     'status'=> false,
	    //     'message' => $err->getMessage(),
	    //     'model'=>null], 422);
	    // }
	    // return response()->json([
		   //  'status'=>true,
		   //  'message'=>('upload success'),
		   //  'model'=>$model], 200);
    }
  
    public function delete(int $id)
    {
    	try {
      		History::destroy($id);
    	} catch (\Exception $err) {
      		logger($err ->getMessage());

	    return response()->json([
	        'status'=> false,
	        'message' => $err->getMessage(),
	        'model'=>null], 422);
    	}
    return response()->json([
      	'status'=>true,
      	'message'=>('file delete successful'),
      	'model'=>null ], 200); 
    }
}
