<?php

namespace App\Interfaces\Repositories;

interface ImageRepositoryInterface{
    
    public function TemporarilySave($image, $folderName);
    public function upload($image, $folderName);
}