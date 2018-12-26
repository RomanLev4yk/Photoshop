<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Http\Requests\StoreImageRequestValidation;
use App\Model\History;

class ImageService
{
	protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function show(int $id)
    {
        return $this->imageRepository->show($id);
    }

    public function store(StoreImageRequestValidation $request)
    {
        return $this->imageRepository->store($request->photo);
    }

    public function deleteImg(int $id)
    {
        return $this->imageRepository->deleteImg($id);
    }

    public function border(Request $request)
    {
    	return $this->imageRepository->border([
            $request->input('color'),
            $request->input('width'),
            $request->input('height')
        ]);
    }

    public function crop(Request $request)
    {
    	return $this->imageRepository->crop([
            $request->input('width'),
            $request->input('height'),
            $request->input('startX'),
            $request->input('startY')
        ]);
    }

    public function filter(Request $request)
    {
    	return $this->imageRepository->filter([
            $request->input('radius'),
            $request->input('sigma')
        ]);
    }

    public function flop()
    {
    	return $this->imageRepository->flop();
    }

    public function rotate(Request $request)
    {
    	return $this->imageRepository->rotate([
            $request->input('direction')
        ]);
    }
}