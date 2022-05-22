<?php

namespace App\Interfaces\Services;

interface ImageServiceInterface{
    
    public function TemporarilySave($image, $folderName);
    public function upload($image, $folderName);
    public function delete($path, $image);
    public function update($image, $folderName);
}