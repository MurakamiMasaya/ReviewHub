<?php

namespace App\Interfaces\Services;

interface EventServiceInterface{
 
    public function getEvent($event);
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($event);
    public function getReviewsTenEach($event);
    public function deleteReview($id);

    public function createEvent($request);
    public function createReview($request);
}