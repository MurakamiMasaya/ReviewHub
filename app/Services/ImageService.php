<?php

namespace App\Services;

use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageService implements ImageServiceInterface{
    
    public function TemporarilySave($image, $folderName){
        $fileName = uniqid(rand().'_');
        $extension = $image->extension();
        $fileNameToStore = $fileName. '.' .$extension;
        $resizedImage = Image::make($image)->resize(500,400)->encode();
        Storage::put('public/'. $folderName .'/tmp/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }

    public function upload($image, $folderName){
        $registeredImage = Storage::get('public/' . $folderName . '/tmp/' . $image);
        Storage::put('public/' . $folderName . '/' . $image, $registeredImage);
        Storage::delete('public/' . $folderName . '/tmp/' . $image);
    }

    public function delete($path, $image){
        Storage::delete($path . $image);
    }

    public function update($image, $folderName){
        // #FIXME: 前回の画像がフォルダに残ってしまう
        $sameImage = Storage::exists('public/'. $folderName .'/'. $image);
        if(!$sameImage){
            $this->upload($image, $folderName);
        }
    }
}