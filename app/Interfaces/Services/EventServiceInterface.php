<?php

namespace App\Interfaces\Services;

interface EventServiceInterface{

    public function getEvent($target, $column = null, $order = null, $paginate = null, $limit = null, $before = null);
    public function searchEvent($target, $column, $order, $paginate = null, $limit = null);

    public function getReview($target, $column, $order = null, $paginate = null, $limit = null);

    public function deleteReview($id);

    public function createEvent($request, $image);
    public function createReview($request);
    public function deleteEvent($id);
}