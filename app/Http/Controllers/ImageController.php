<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\History;
use App\Services\ImageService;

class ImageController extends Controller
{
    print_r('1111');
    // public function show(int $id)
    // {
    //     try {
    //         History::findOrFail($id);
    //     } 
    //     catch (\Exception $err) {
    //         logger($err->getMessage());

    //         return response()->json([
    //             'status'=> false,
    //             'message' => $err->getMessage()], 422);
    //     }

    //     return new History($id);
    }
            



    public function edit(Request $request)
    {
        
    }





    public function delete(int $id)
    {
        return DB::transaction(function () use($id) {

            try {
                $model = History::findOrFail($id);
            }
            catch (\Exception $err) {
                logger($err->getMessage());

                return response()->json([
                    'status'=> false,
                    'message' => $err->getMessage()], 422);
            }
            try {
                $model->delete();
            } 
            catch (\Exception $err) {
                logger($err ->getMessage());

                return response()->json([
                    'status'=> false,
                    'message' => $err->getMessage(),
                    'model'=>null], 422);
            }
            return response()->json([
                'status'=>true,
                'message'=>('delete successful'),
                'model'=>null ], 200);
        });    
    }
}