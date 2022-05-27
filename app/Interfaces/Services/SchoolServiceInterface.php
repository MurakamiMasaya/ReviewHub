<?php

namespace App\Interfaces\Services;

interface SchoolServiceInterface{

    public function getSchool($target, $order = null, $paginate = null, $limit = null);
    public function searchSchool($target, $column, $order, $paginate = null, $limit = null);

    public function getReviews($target, $column, $order, $paginate = null, $limit = null);

    public function createReview($request);
    public function deleteReview($id);
    
}