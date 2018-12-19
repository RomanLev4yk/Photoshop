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
        return $this->imageService->crop($request);
    }
}
