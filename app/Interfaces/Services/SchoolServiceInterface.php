<?php

namespace App\Interfaces\Services;

interface SchoolServiceInterface{

    public function getSchool($target, $order = null, $paginate = null, $limit = null);
    public function searchSchool($target, $column, $order, $paginate = null, $limit = null);
    public function createSchool($request);
    public function deleteSchool($id);
    
    public function createReview($request);
    public function getReview($target, $column, $order = null, $paginate = null, $limit = null);
    public function deleteReview($id);
    
    public function createSchoolGr($id);
    public function deleteSchoolGr($id);
    public function createSchoolReviewGr($id);
    public function deleteSchoolReviewGr($id);
}