<?php

namespace App\Services;

use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Repositories\CompanyRepositoryInterface;

class CompanyService implements CompanyServiceInterface {

    private $companyRepository;

    public function __construct(
        CompanyRepositoryInterface $companyRepository
        ) {
        $this->companyRepository = $companyRepository;
    }

    public function getCompany($company){
        return $this->companyRepository->getCompany($company);
    }

    public function getTopThree(){
        return $this->companyRepository->getTopThree();
    }

    public function getTwelveEach(){
        return $this->companyRepository->getTwelveEach(); 
    }

    public function getSearchTenEach($target){
        return $this->companyRepository->getSearchTenEach($target);
    }

    public function getSearchAll($target){
        return $this->companyRepository->getSearchAll($target);
    }

    public function getReviewsTenEach($company){
        return $this->companyRepository->getReviewsTenEach($company);
    }

    public function createReview($request){
        return $this->companyRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->companyRepository->deleteReview($id);
    }
}