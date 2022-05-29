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

    public function getCompany($target, $order = null, $paginate = null, $limit = null){
        return $this->companyRepository->getCompany($target, $order, $paginate, $limit);
    }

    public function searchCompany($target, $column, $order, $paginate = null, $limit = null){
        return $this->companyRepository->searchCompany($target, $column, $order, $paginate, $limit);
    }

    public function getReview($target, $column, $order = null, $paginate = null, $limit = null){
        return $this->companyRepository->getReview($target, $column, $order, $paginate, $limit);
    }

    public function createReview($request){
        return $this->companyRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->companyRepository->deleteReview($id);
    }

    public function createCompany($request){
        return $this->companyRepository->createCompany($request);
    }

    public function deleteCompany($id){
        return $this->companyRepository->deleteCompany($id);
    }
}