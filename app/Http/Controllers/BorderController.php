<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Model\History;
use Illuminate\Support\Facades\DB;
use Imagick;

class BorderController extends Controller
{
    public function edit(Request $request) {

        $id = DB::table('histories')->orderBy('id', 'DESC')->take(1)->value('id');
        $params = [
            'color' =>$request->input('color'),
            'width' =>$request->input('width'),
            'height' =>$request->input('height')];
        $edit_file = History::findOrFail($id);
        $realpath = realpath('D:\OSPanel\domains\PS\storage\app\\' . $edit_file["result_file_path"]);
        $imagick = new Imagick ($realpath);
        try{
            $imagick->borderImage($params['color'], $params['width'], $params['height']);
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
        $edit_history = 'image border';
        
        return GlobalService::fileStore($path, $edit_history);
    }
}
