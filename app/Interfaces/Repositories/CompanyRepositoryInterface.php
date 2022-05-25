<?php

namespace App\Interfaces\Repositories;

interface CompanyRepositoryInterface{
    
    public function getCompany($company);
    public function getTopThree();
    public function getTwelveEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviewsTenEach($company);
    public function getReviewsTiedUserTenEach($user);

    public function createReview($request);
    public function deleteReview($id);
}