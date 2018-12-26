<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;

class BorderController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function borderImage(Request $request)
    {
        try {
        	$result = $this->imageService->border($request);
        }
        catch (\Exception $err) {
        	return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }
}
