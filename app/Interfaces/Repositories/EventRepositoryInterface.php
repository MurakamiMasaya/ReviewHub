<?php

namespace App\Interfaces\Repositories;

interface EventRepositoryInterface{
 
    public function getEvent($event);
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($event);
    public function getReviewsTenEach($event);
    public function getReviewsTiedUserTenEach($user);
    public function deleteReview($id);

    public function createEvent($request);
    public function createReview($request);
}