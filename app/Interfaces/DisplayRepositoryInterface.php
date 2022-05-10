<?php

namespace App\Interfaces;

interface DisplayRepositoryInterface{
    
    public function getTargetsThreeEach($models);
    public function getTargetsTenEach($models);
    public function getTargetsTwelveEach($models);
    public function getArticlesEightEach();
    public function getTechnologyAll();
    public function getConditionAll();
    public function getAuthenticatedUser();
}