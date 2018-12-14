<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;

class StoreController extends Controller
{
	public function show(int $id){

    	try {
      		$model = History::findOrFail($id);
    	} catch (\Exception $err) {
      		logger($err->getMessage());

      	return response()->json([
        	'status'=> false,
        	'message' => $err->getMessage(),
        	'model'=>null], 422);
    	}

    	return response()->json([
      		'status'=>true,
      		'model'=>$model,], 200);
  }

	public function store(Request $request){

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

		return GlobalService::fileStore($path, $edit_history);
	}
  
    public function delete(int $id){
      
      $edit_file = History::findOrFail($id);
      try {
          unlink('D:\OSPanel\domains\PS\storage\app\\' . $edit_file["result_file_path"]);;
      } catch (\Exception $err) {
          logger($err ->getMessage());

      return response()->json([
          'status'=> false,
          'message' => $err->getMessage(),
          'model'=>null], 422);
      }      

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
      	'message'=>('file delete successful')], 200); 
    }
}
