<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;

class CropController extends Controller
{
	protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function cropImage(Request $request)
    {
    	try {
        	$result = $this->imageService->crop($request);
        }
        catch (\Exception $err) {
        	return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }
}
