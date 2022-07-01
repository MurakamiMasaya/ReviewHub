<?php

namespace App\Interfaces\Repositories;

interface DisplayRepositoryInterface{
    
    public function getTechnologyAll();
    public function getConditionAll();
    
    public function getAuthenticatedUser();
    public function getUsers();
    public function searchUser($target, $sort);

    public function deleteAcount($id);

    public function createContact($request);

    public function createReport($request);
    public function createReviewReport($request);

    public function getUser($id);
    public function deleteUser($id);
    
}