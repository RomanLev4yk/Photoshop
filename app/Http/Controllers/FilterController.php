<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;

class FilterController extends Controller
{

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function filterImage(Request $request)
    {
        return $this->imageService->filter($request);
    }
}
