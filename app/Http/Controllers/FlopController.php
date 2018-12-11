<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;
use Imagick;

class FlopController extends Controller
{
    public function edit(int $id) {

    	$edit_file = History::findOrFail($id);
    	$realpath = realpath('D:\OSPanel\domains\PS\storage\app\\' . $edit_file["result_file_path"]);
		$imagick = new Imagick ($realpath);
		$imagick->rotateimage('black', 90);
		$extension = explode(".", $realpath);
	    $filename = 'edited-photo-' . time() . '.' . $extension[1];
	    file_put_contents( 'D:\OSPanel\domains\PS\storage\app\photos\\' . $filename, $imagick);
	    $path = 'photos/' . $filename;
	    $edit_history = 'image rotate';
	    
		return GlobalService::fileStore($path, $edit_history);
	}
  
    public function delete()
    {
        
    }
}
