<?php

namespace App\Interfaces;

interface SearchRepositoryInterface{
    
    public function getSearchTargetsTenEach($model, $column, $target);
    public function getSearchTargetsAll($model, $column, $target);
}