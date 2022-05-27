<?php

namespace App\Interfaces\Repositories;

interface EventRepositoryInterface{

    public function getEvent($target, $column, $order, $paginate, $limit);
    public function searchEvent($target, $column, $order, $paginate, $limit);

    public function createReview($request);
    public function getReviews($target, $column, $order, $paginate, $limit);
    public function deleteReview($id);


    public function createEvent($request, $image);
    public function deleteEvent($event);
}