<?php

namespace App\Interfaces\Services;

interface CompanyServiceInterface{
    public function getCompany($target, $order = null, $period = null, $paginate = null, $limit = null);
    public function searchCompany($target, $column, $order, $paginate = null, $limit = null);

    public function getReview($target, $column, $order = null, $paginate = null, $limit = null);

    public function createReview($request);
    public function deleteReview($id);

    public function createCompany($request);
    public function deleteCompany($id);

    public function createCompanyGr($id);
    public function deleteCompanyGr($id);
    public function createCompanyReviewGr($id);
    public function deleteCompanyReviewGr($id);

}