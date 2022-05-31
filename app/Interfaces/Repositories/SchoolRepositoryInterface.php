<?php

namespace App\Interfaces\Repositories;

interface SchoolRepositoryInterface{

    public function getSchool($target, $order, $paginate, $limit);
    public function searchSchool($target, $column, $order, $paginate, $limit);
    public function createSchool($request);
    public function deleteSchool($id);

    public function createReview($request);
    public function getReview($target, $column, $order, $paginate, $limit);
    public function deleteReview($id);

    public function createSchoolGr($id);
    public function deleteSchoolGr($id);
    public function createSchoolReviewGr($id);
    public function deleteSchoolReviewGr($id);
}