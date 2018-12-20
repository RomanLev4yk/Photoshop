<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Model\History;
use Illuminate\Support\Facades\DB;
//use App\Http\Requests\StoreImageRequestValidation;


class ImageRepository
{

	protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function show(int $id)
    {
        return $this->history->show($id);
    }

    public function store(Request $request)
    {
        return $this->history->store($request);
    }

    public function deleteImg(int $id)
    {
        return $this->history->deleteImg($id);
    }

    public function border(Request $request)
    {
    	return $this->history->border($request);
    }

    public function crop(Request $request)
    {
    	return $this->history->crop($request);
    }

    public function filter(Request $request)
    {
    	return $this->history->filter($request);
    }

    public function flop(Request $request)
    {
    	return $this->history->flop($request);
    }

    public function rotate(Request $request)
    {
    	return $this->history->rotate($request);
    }
	
	static function fileStore ($path, $edit_history)
	{	
		$model = new History;
	    try{
	      	$model = $model->fill([
	        'edit_history'=> $edit_history,
	        'result_file_path'=> $path
	      	]);
	      	$model->save();
	    }
	    catch (\Exception $err){
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

	static function findLastId()
	{
    	return $id = DB::table('histories')->orderBy('id', 'DESC')->take(1)->value('id');
    }
}