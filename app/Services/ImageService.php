<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
//use App\Http\Requests\StoreImageRequestValidation;
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

    public function store(Request $request)
    {
        return $this->imageRepository->store($request);
    }

    public function deleteImg(int $id)
    {
        return $this->imageRepository->deleteImg($id);
    }

    public function border(Request $request)
    {
    	return $this->imageRepository->border($request);
    }

    public function crop(Request $request)
    {
    	return $this->imageRepository->crop($request);
    }

    public function filter(Request $request)
    {
    	return $this->imageRepository->filter($request);
    }

    public function flop(Request $request)
    {
    	return $this->imageRepository->flop($request);
    }

    public function rotate(Request $request)
    {
    	return $this->imageRepository->rotate($request);
    }
}