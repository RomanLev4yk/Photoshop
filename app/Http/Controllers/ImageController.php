<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Requests\StoreImageRequestValidation;


class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function showImage(int $id)
    {
        try {
            $result = $this->imageService->show($id);
        }
        catch (\Exception $err) {
            return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }

    public function storeImage(StoreImageRequestValidation $request)
    {
        try {
            $result = $this->imageService->store($request);
        }
        catch (\Exception $err) {
            return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }

    public function deleteImage(int $id)
    {
        try {
            $result = $this->imageService->deleteImg($id);
        }
        catch (\Exception $err) {
            return response()->json($result, 402);
        }

        return response()->json($result, 200);
    }
}
