<?php

namespace App\Repositories;

use App\Model\History;

class ImageRepository
{

	protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function show(int $id)
    {
        try{
            $model = $this->history->show($id);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function store($photo)
    {
        try{
            $model = $this->history->store($photo);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function deleteImg(int $id)
    {
        try{
            $this->history->deleteImg($id);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'File delete success'
        ];
    }

    public function border($params)
    {
        try{
            $model = $this->history->border($params);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function crop($params)
    {
        try{
            $model = $this->history->crop($params);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function filter($params)
    {
    	try{
            $model = $this->history->filter($params);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function flop()
    {
    	try{
            $model = $this->history->flop();
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }

    public function rotate($params)
    {
    	try{
            $model = $this->history->rotate($params);
        }
        catch (\Exception $err){
            return [
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null
            ];
        }

        return [
            'status'=>true,
            'message' => 'success',
            'model'=>$model
        ];
    }
}