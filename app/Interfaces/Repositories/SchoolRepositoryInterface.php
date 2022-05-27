<?php

namespace App\Interfaces\Repositories;

interface SchoolRepositoryInterface{

    public function getSchool($target, $order, $paginate, $limit);
    public function searchSchool($target, $column, $order, $paginate, $limit);

    public function getReviews($target, $column, $order, $paginate, $limit);

    public function createReview($request);
    public function deleteReview($id);
}