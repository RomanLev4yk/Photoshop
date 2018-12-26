<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\ImageRepository;
use App\Packages\BasePhotoshop;

class History extends Model
{
    protected $table='histories';
    protected $fillable = ['edit_history', 'result_file_path'];
    protected $basephotoshop;

    public function __construct()
    {
        $this->basephotoshop = new BasePhotoshop;
    }

    public function show(int $id)
    {
        try{
            $model = History::findOrFail($id);
        }
        catch (\Exception $err){
            throw $err;
        }

        return $model;
    }

    public function store($photo)
    {
        $extension = $photo->getClientOriginalExtension();
        $filename = 'profile-photo-' . time() . '.' . $extension;
        $path = $photo->storeAs('photos', $filename);
        $edit_history = 'file store';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function deleteImg(int $id)
    {      
        $edit_file = History::findOrFail($id);
        $find_file = explode("app", __DIR__);

        $this->basephotoshop->deleteImageFile($edit_file, $find_file);     
        try{
            History::destroy($id);
        }
        catch (\Exception $err){
            throw $err;
        }

        return true; 
    }

    public function border($params)
    {
        $edit_file = History::findOrFail($this->basephotoshop->findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = $this->basephotoshop->border($realpath, $params);
        $filename = $this->basephotoshop->saveEditImageFile($realpath, $imagick, $find_file);

        $path = 'photos/' . $filename;
        $edit_history = 'image border';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function crop($params)
    {
        $edit_file = History::findOrFail($this->basephotoshop->findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = $this->basephotoshop->crop($realpath, $params);
        $filename = $this->basephotoshop->saveEditImageFile($realpath, $imagick, $find_file);
        
        $path = 'photos/' . $filename;
        $edit_history = 'image crop';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function filter($params)
    {
        $edit_file = History::findOrFail($this->basephotoshop->findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = $this->basephotoshop->filter($realpath, $params);
        $filename = $this->basephotoshop->saveEditImageFile($realpath, $imagick, $find_file);

        $path = 'photos/' . $filename;
        $edit_history = 'image filter';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function flop()
    {
        $edit_file = History::findOrFail($this->basephotoshop->findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = $this->basephotoshop->flop($realpath);
        $filename = $this->basephotoshop->saveEditImageFile($realpath, $imagick, $find_file);

        $path = 'photos/' . $filename;
        $edit_history = 'image flop';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function rotate($params)
    {
        $edit_file = History::findOrFail($this->basephotoshop->findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = $this->basephotoshop->rotate($realpath, $params);
        $filename = $this->basephotoshop->saveEditImageFile($realpath, $imagick, $find_file);

        $path = 'photos/' . $filename;
        $edit_history = 'image rotate';

        return $this->fileStoreDB($path, $edit_history);
    }

    public function fileStoreDB ($path, $edit_history)
    {   
        $model = new History;
        try{
            $model = $model->fill([
            'edit_history'=> $edit_history,
            'result_file_path'=> $path
            ]);
            $model->save();
        }
        catch (\Exception $err){
            throw $err;
        }
        
        return $model;
    }
}
