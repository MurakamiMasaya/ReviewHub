<?php

namespace App\Interfaces\Services;

interface CompanyServiceInterface{
    public function getCompany($target, $order = null, $paginate = null, $limit = null);
    public function searchCompany($target, $column, $order, $paginate = null, $limit = null);

    public function getReviews($target, $column, $order, $paginate = null, $limit = null);

    public function createReview($request);
    public function deleteReview($id);
}