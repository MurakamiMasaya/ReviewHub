<?php

namespace App\Interfaces\Services;

interface DisplayServiceInterface{
    
    public function getTechnologyAll();
    public function getConditionAll();

    public function getUsers();
    public function searchUser($target, $sort);
    public function getAuthenticatedUser();
    public function deleteAcount($id);

    public function getAllReviewsTenEach($id);

    public function createContact($request);
    public function createReport($request);
    public function createReviewReport($request);

    public function judgePeriod($period);

    public function calculateTotalGrs($allReviews, $articles, $events);

    public function getUser($id);
    public function deleteUser($id);
}