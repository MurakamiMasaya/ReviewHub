<?php

namespace App\Services;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Repositories\DisplayRepositoryInterface;
use App\Interfaces\Repositories\EventRepositoryInterface;
use App\Interfaces\Repositories\SchoolRepositoryInterface;

class DisplayService implements DisplayServiceInterface {

    private $displayRepository;
    private $articleRepository;
    private $companyRepository;
    private $schoolRepository;
    private $eventRepository;

    public function __construct(
        DisplayRepositoryInterface $displayRepository,
        ArticleRepositoryInterface $articleRepository,
        CompanyRepositoryInterface $companyRepository,
        SchoolRepositoryInterface $schoolRepository,
        EventRepositoryInterface $eventRepository
        
        ) {
        $this->displayRepository = $displayRepository;
        $this->articleRepository = $articleRepository;
        $this->companyRepository = $companyRepository;
        $this->schoolRepository = $schoolRepository;
        $this->eventRepository = $eventRepository;
    }

    public function getAuthenticatedUser(){
        return $this->displayRepository->getAuthenticatedUser();
    }

    public function getUser(){
        return $this->displayRepository->getUser();
    }

    public function searchUser($target, $sort){
        return $this->displayRepository->searchUser($target, $sort);
    }

    public function getTechnologyAll(){
        return $this->displayRepository->getTechnologyAll();
    }

    public function getConditionAll(){
        return $this->displayRepository->getConditionAll();
    }

    public function getAllReviewsTenEach($id){

        $allReviews = [];

        $c_reviews = $this->companyRepository->getReviews($id, 'user_id', 'updated_at', 10, null);
        $s_reviews = $this->schoolRepository->getReviews($id, 'user_id', 'updated_at', 10, null);
        $e_reviews = $this->eventRepository->getReviews($id, 'user_id', 'updated_at', 10, null);
        $a_reviews = $this->articleRepository->getReviews($id, 'user_id', 'updated_at', 10, null);

        array_push($allReviews, [
            'c_reviews' => $c_reviews, 
            's_reviews' => $s_reviews, 
            'e_reviews' => $e_reviews, 
            'a_reviews' => $a_reviews]);
        return $allReviews;
    }
    
    public function createContact($request){
        return $this->displayRepository->createContact($request);
    }
    
    public function deleteAcount($id){
        return $this->displayRepository->deleteAcount($id);
    }

}