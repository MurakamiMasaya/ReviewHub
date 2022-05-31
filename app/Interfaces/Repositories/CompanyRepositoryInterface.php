<?php

namespace App\Interfaces\Repositories;

interface CompanyRepositoryInterface{
    
    public function getCompany($target, $order, $paginate, $limit);
    public function searchCompany($target, $column, $order, $paginate, $limit);

    public function getReview($target, $column, $order, $paginate, $limit);

    public function createReview($request);
    public function deleteReview($id);

    public function createCompany($request);
    public function deleteCompany($id);

    public function createCompanyGr($id);
    public function deleteCompanyGr($id);
    public function createCompanyReviewGr($id);
    public function deleteCompanyReviewGr($id);
}