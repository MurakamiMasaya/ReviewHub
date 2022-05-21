<?php

namespace App\Services;

use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Repositories\SchoolRepositoryInterface;

class SchoolService implements SchoolServiceInterface {

    private $schoolRepository;

    public function __construct(
        SchoolRepositoryInterface $schoolRepository
        ) {
        $this->schoolRepository = $schoolRepository;
    }

    public function getSchool($company){
        return $this->schoolRepository->getSchool($company);
    }

    public function getTopThree(){
        return $this->schoolRepository->getTopThree();
    }

    public function getTwelveEach(){
        return $this->schoolRepository->getTwelveEach();
    }

    public function getSearchTenEach($target){
        return $this->schoolRepository->getSearchTenEach($target);
    }

    public function getSearchAll($target){
        return $this->schoolRepository->getSearchAll($target);
    }

    public function getReviewsTenEach($school){
        return $this->schoolRepository->getReviewsTenEach($school);
    }

    public function getReviewsTiedUserTenEach($user){
        return $this->schoolRepository->getReviewsTiedUserTenEach($user);
    }

    public function deleteReview($id){
        return $this->schoolRepository->deleteReview($id);
        
    }
}