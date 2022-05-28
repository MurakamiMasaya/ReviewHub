<?php

namespace App\Interfaces\Repositories;

interface DisplayRepositoryInterface{
    
    public function getTechnologyAll();
    public function getConditionAll();
    
    public function getAuthenticatedUser();
    public function getUser();
    public function searchUser($target, $sort);

    public function deleteAcount($id);

    public function createContact($request);
    
}