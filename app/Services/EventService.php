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

}