<?php

namespace App\Interfaces\Repositories;

interface DisplayRepositoryInterface{
    
    public function getTechnologyAll();
    public function getConditionAll();
    public function getAuthenticatedUser();
    public function deleteAcount($id);
}