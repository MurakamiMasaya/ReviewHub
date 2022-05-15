<?php

namespace App\Interfaces;

interface ImageRepositoryInterface{
    
    public function TemporarilySave($image, $folderName);
    public function upload($image, $folderName);
}