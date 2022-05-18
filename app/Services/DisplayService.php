<?php

namespace App\Services;

use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Repositories\DisplayRepositoryInterface;

class DisplayService implements DisplayServiceInterface {

    private $displayRepository;

    public function __construct(
        DisplayRepositoryInterface $displayRepository
        ) {
        $this->displayRepository = $displayRepository;
    }

    public function getAuthenticatedUser(){
        return $this->displayRepository->getAuthenticatedUser();
    }

    public function getTechnologyAll(){
        return $this->displayRepository->getTechnologyAll();
    }

    public function getConditionAll(){
        return $this->displayRepository->getConditionAll();
    }
}