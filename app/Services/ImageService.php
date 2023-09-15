<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService{

    protected $baseDir = 'dynamic-images/';

    public function upload( $file,  $path, $config = [])
    {
        //return Storage::disk('public')->put($this->baseDir.$path, $file);

        $dirPath = $this->baseDir.$path.'/';
        $fileName = time().'-'.uniqid().'.webp';

        if(in_array('small', $config)){
            $savePath = $dirPath.'sm-'.$fileName;
            $photo = Image::make($file)
                ->resize(337, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('webp',100);
            Storage::disk('public')->put($savePath, $photo);
        }

        if(in_array('medium', $config)){
            $savePath = $dirPath.'md-'.$fileName;
            $photo = Image::make($file)
                ->resize(416, 508, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('webp',80);
            Storage::disk('public')->put($savePath, $photo);
        }

        $file->storeAs('public/'.$dirPath, $fileName);
        return $dirPath.$fileName;

    }

    public function delete( $path )
    {
        if(!$path) return;
        $info = pathinfo($path);
        $small = $info['dirname'].'/sm-'.$info['basename'];
        $mediam = $info['dirname'].'/md-'.$info['basename'];
        Storage::disk('public')->delete($path);
        Storage::disk('public')->delete($small);
        Storage::disk('public')->delete($mediam);
    }

    public static function show( $path, $size = null)
    {
        if(!$path) return;
        $mainPath = $path;
        if($size != null){
            $info = pathinfo($path);
            $mainPath = $info['dirname'].'/'.$size.$info['basename'];
        }
        return Storage::disk('public')->url($mainPath);
    }
}
