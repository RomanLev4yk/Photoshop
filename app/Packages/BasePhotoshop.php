<?php

namespace App\Packages;

use Illuminate\Support\Facades\DB;
use Imagick;

class BasePhotoshop 
{
	public function border($realpath, $params)
	{
		$imagick = new Imagick ($realpath);
        try{
            $imagick->borderImage($params[0], $params[1], $params[2]);
        }
        catch (\Exception $err){
            throw $err;
        }

        return $imagick;
	}

	public function crop($realpath, $params)
	{
		$imagick = new Imagick ($realpath);
        try{
            $imagick->cropimage($params[0], $params[1], $params[2], $params[3]);
        }
        catch (\Exception $err){
            throw $err;
        }

        return $imagick;
	}

	public function filter($realpath, $params)
	{
		$imagick = new Imagick ($realpath);
        try{
            $imagick->charcoalImage($params[0], $params[1]);
        }
        catch (\Exception $err){
            throw $err;
        }

        return $imagick;
	}

	public function flop($realpath)
	{
		$imagick = new Imagick ($realpath);
        try{
            $imagick->flopimage();
        }
        catch (\Exception $err) {
            throw $err;
        }

        return $imagick;
	}

	public function rotate($realpath, $params)
	{
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

        return $imagick;
	}

	public function saveEditImageFile($realpath, $imagick, $find_file)
	{
		try{
			$extension = explode(".", $realpath);
        	$filename = 'edited-photo-' . time() . '.' . $extension[1];
        	file_put_contents( $find_file[0] . "storage\app\photos\\" . $filename, $imagick);
        }
        catch (\Exception $err){
            throw $err;
        }

        return $filename;
	}

	public function deleteImageFile($edit_file, $find_file)
	{
		try{
            unlink( $find_file[0] . "storage\app\\" . $edit_file["result_file_path"]);;
        }
        catch (\Exception $err){
            return true;
        }

        return true;
	}

	public function findLastId()
	{
    	return $id = DB::table('histories')->orderBy('id', 'DESC')->take(1)->value('id');
    }
}