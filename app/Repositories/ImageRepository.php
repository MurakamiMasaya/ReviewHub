<?php

namespace App\Repositories;

use App\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageRepository implements ImageRepositoryInterface{
    
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
}