<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;

class FlopController extends Controller
{

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function flopImage()
    {
        try {
        	$result = $this->imageService->flop();
        }
        catch (\Exception $err) {
        	return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }
}
