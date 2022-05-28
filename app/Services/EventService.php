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
   
    public function getEvent($target, $column = null, $order = null, $paginate = null, $limit = null ,$before = null){
        return $this->eventRepository->getEvent($target, $column, $order, $paginate, $limit, $before);
    }

    public function searchEvent($target, $column, $order, $paginate = null, $limit = null){
        return $this->eventRepository->searchEvent($target, $column, $order, $paginate, $limit);
    }

    public function getReviews($target, $column, $order, $paginate = null, $limit = null){
        return $this->eventRepository->getReviews($target, $column, $order, $paginate, $limit);
    }

    public function createEvent($request, $image){
        return $this->eventRepository->createEvent($request, $image);
    }

    public function deleteEvent($id){
        return $this->eventRepository->deleteEvent($id);
    }

    public function createReview($request){
        return $this->eventRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->eventRepository->deleteReview($id);
    }


}