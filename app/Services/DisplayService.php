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

        $c_reviews = $this->companyRepository->getReview($id, 'user_id', 'updated_at', 10, null);
        $s_reviews = $this->schoolRepository->getReview($id, 'user_id', 'updated_at', 10, null);
        $e_reviews = $this->eventRepository->getReview($id, 'user_id', 'updated_at', 10, null);
        $a_reviews = $this->articleRepository->getReview($id, 'user_id', 'updated_at', 10, null);

        array_push($allReviews, [
            'c_reviews' => $c_reviews, 
            's_reviews' => $s_reviews, 
            'e_reviews' => $e_reviews, 
            'a_reviews' => $a_reviews]
        );
        return $allReviews;
    }
    
    public function createContact($request){
        return $this->displayRepository->createContact($request);
    }
    
    public function deleteAcount($id){
        return $this->displayRepository->deleteAcount($id);
    }

    public function createReport($request){
        return $this->displayRepository->createReport($request);
    }

    public function createReviewReport($request){
        return $this->displayRepository->createReviewReport($request);
    }

    public function judgePeriod($period){

        if($period === 'month'){
            $period = 30;
        }
        if($period === 'year'){
            $period = 365;
        }
        //全期間を表示できるように、期間を5万日にしています
        if($period === 'all'){
            $period = 50000;
        }

        return $period;
    }

    public function calculateTotalGrs($allReviews, $articles, $events){

        $totalGrs = 0;

        foreach($allReviews[0]['c_reviews'] as $review){
            $totalGrs += $review->gr;
        }
        foreach($allReviews[0]['s_reviews'] as $review){
            $totalGrs += $review->gr;
        }
        foreach($allReviews[0]['e_reviews'] as $review){
            $totalGrs += $review->gr;
        }
        foreach($allReviews[0]['a_reviews'] as $review){
            $totalGrs += $review->gr;
        }

        foreach($articles as $article){
            $totalGrs += $article->gr;
        }
        foreach($events as $event){
            $totalGrs += $event->gr;
        }

        return $totalGrs;

    }

}