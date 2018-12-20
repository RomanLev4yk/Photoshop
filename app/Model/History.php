<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
//use App\Http\Requests\StoreImageRequestValidation;
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
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        return response()->json([
            'status'=>true,
            'model'=>$model,], 200);
    }

    public function store(Request $request)
    {
        try{
            $validation = $request->validate([
            'photo' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            ]);
        }
        catch (\Exception $err){
            logger($err->getMessage());

            return response()->json([
                'status'=> false,
                'message' => $err->getMessage()]);
        }

        //$validation->photo = $request->input('photo');

        $file = $validation['photo'];
        $extension = $file->getClientOriginalExtension();
        $filename = 'profile-photo-' . time() . '.' . $extension;
        $path = $file->storeAs('photos', $filename);
        $edit_history = 'file store';

        return ImageRepository::fileStore($path, $edit_history);
    }

    public function deleteImg(int $id)
    {      
        $edit_file = History::findOrFail($id);
        $find_file = explode("app", __DIR__);
        try{
            unlink( $find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);;
        }
        catch (\Exception $err){
            logger($err ->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }      

        try{
            History::destroy($id);
        }
        catch (\Exception $err){
            logger($err ->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        return response()->json([
            'status'=>true,
            'message'=>('file delete successful')], 200); 
    }

    public function border(Request $request)
    {
		$params = [
            'color' =>$request->input('color'),
            'width' =>$request->input('width'),
            'height' =>$request->input('height')];

        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->borderImage($params['color'], $params['width'], $params['height']);
        }
        catch (\Exception $err){
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image border';

        return ImageRepository::fileStore($path, $edit_history);
    }

    public function crop(Request $request)
    {
        $params = [
            'width' =>$request->input('width'),
            'height' =>$request->input('height'),
            'startX' =>$request->input('startX'),
            'startY' =>$request->input('startY')];

        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->cropimage($params['width'], $params['height'], $params['startX'], $params['startY']);
        }
        catch (\Exception $err){
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image crop';

        return ImageRepository::fileStore($path, $edit_history);
    }

    public function filter(Request $request)
    {
        $params = [
            'radius' =>$request->input('radius'),
            'sigma' =>$request->input('sigma')];

        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->charcoalImage($params['radius'], $params['sigma']);
        }
        catch (\Exception $err){
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image filter';

        return ImageRepository::fileStore($path, $edit_history);
    }

    public function flop(Request $request)
    {
        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            $imagick->flopimage();
        }
        catch (\Exception $err) {
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image flop';

        return ImageRepository::fileStore($path, $edit_history);
    }

    public function rotate(Request $request)
    {
        $params = [
            'direction'=>$request->input('direction')];

        $edit_file = History::findOrFail(ImageRepository::findLastId());
        $find_file = explode("app", __DIR__); 
        $realpath = realpath($find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);

        $imagick = new Imagick ($realpath);
        try{
            if ($params['direction'] == 'right'){
                $imagick->rotateimage('black', 90);
            }
            elseif($params['direction'] == 'left'){
                $imagick->rotateimage('black', -90);
            }
            else {
                echo('Set the "left" or "right" rotate direction');
                exit;
            }
        }
        catch (\Exception $err){
            logger($err->getMessage());

            return response()->json([
            'status'=> false,
            'message' => $err->getMessage(),
            'model'=>null], 422);
        }

        $extension = explode(".", $realpath);
        $filename = 'edited-photo-' . time() . '.' . $extension[1];
        file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        $path = 'photos/' . $filename;
        $edit_history = 'image rotate';

        return ImageRepository::fileStore($path, $edit_history);
    }
}
