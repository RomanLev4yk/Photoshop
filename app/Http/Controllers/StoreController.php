<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;
//use App\Http\Requests\StoreImageRequestValidation;

class StoreController extends Controller
{
  protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function showImage(int $id)
    {
        return $this->imageService->show($id);
    }

    public function storeImage(Request $request)
    {
        return $this->imageService->store($request);
    }

    public function deleteImage(int $id)
    {
        return $this->imageService->deleteImg($id);
    }
}
