<?php

namespace App\Interfaces\Services;

interface DisplayServiceInterface{
    
    public function getTechnologyAll();
    public function getConditionAll();
    public function getAuthenticatedUser();

    public function getAllReviewsTenEach($id);
    public function deleteAcount($id);
}