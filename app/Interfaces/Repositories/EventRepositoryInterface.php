<?php

namespace App\Interfaces\Repositories;

interface EventRepositoryInterface{

    public function getEvent($target, $column, $order, $period, $paginate, $limit, $before);
    public function searchEvent($target, $column, $order, $paginate, $limit);

    public function createReview($request);
    public function getReview($target, $column, $order, $paginate, $limit);
    public function deleteReview($id);


    public function createEvent($request, $image);
    public function deleteEvent($event);

    public function createEventGr($id);
    public function deleteEventGr($id);
    public function createEventReviewGr($id);
    public function deleteEventReviewGr($id);
}