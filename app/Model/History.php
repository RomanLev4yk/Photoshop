<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Imagick;

class History extends Model
{
    protected $table='histories';
    protected $fillable = ['edit_history', 'result_file_path'];

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

        return $this->fileStore($path, $edit_history);
    }

    public function deleteImg(int $id)
    {      
        $edit_file = History::findOrFail($id);
        $find_file = explode("app", __DIR__);
        try{
            unlink( $find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);;
        }
        catch (\Exception $err){
            throw $err;
        }      

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
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->borderImage($params[0], $params[1], $params[2]);
        }
        catch (\Exception $err){
            throw $err;
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image border';

        return $this->fileStore($path, $edit_history);
    }

    public function crop($params)
    {
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->cropimage($params[0], $params[1], $params[2], $params[3]);
        }
        catch (\Exception $err){
            throw $err;
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image crop';

        return $this->fileStore($path, $edit_history);
    }

    public function filter($params)
    {
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->charcoalImage($params[0], $params[1]);
        }
        catch (\Exception $err){
            throw $err;
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image filter';

        return $this->fileStore($path, $edit_history);
    }

    public function flop()
    {
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->flopimage();
        }
        catch (\Exception $err) {
            throw $err;
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image flop';

        return $this->fileStore($path, $edit_history);
    }

    public function rotate($params)
    {
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            if ($params[0] == 'right'){
                $imagick->rotateimage('black', 90);
            }
            elseif($params[0] == 'left'){
                $imagick->rotateimage('black', -90);
            }
            else {
                echo('Set the "left" or "right" rotate direction');
                exit;
            }
        }
        catch (\Exception $err){
            throw $err;
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image rotate';

        return $this->fileStore($path, $edit_history);
    }

    public function fileStore ($path, $edit_history)
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
