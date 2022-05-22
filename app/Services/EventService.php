<?php

namespace App\Services;

use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Repositories\EventRepositoryInterface;

class EventService implements EventServiceInterface {

    private $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
        ) {
        $this->eventRepository = $eventRepository;
    }

    public function getEvent($event){
        return $this->eventRepository->getEvent($event);
    }

    public function getEventTiedUserTenEach($user){
        return $this->eventRepository->getEventTiedUserTenEach($user);
    }

    public function getTenEach(){
        return $this->eventRepository->getTenEach(); 
    }

    public function getSearchTenEach($target){
        return $this->eventRepository->getSearchTenEach($target);
    }

    public function getSearchAll($target){
        return $this->eventRepository->getSearchAll($target);
    }

    public function getReviews($event){
        return $this->eventRepository->getReviews($event);
    }

    public function getReviewsTenEach($event){
        return $this->eventRepository->getReviewsTenEach($event);
    }

    public function createEvent($request, $image){
        return $this->eventRepository->createEvent($request, $image);
    }

    public function createReview($request){
        return $this->eventRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->eventRepository->deleteReview($id);
    }

    public function deleteEvent($event){
        return $this->eventRepository->deleteEvent($event);
    }

}