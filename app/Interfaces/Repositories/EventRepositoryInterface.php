<?php

namespace App\Interfaces\Repositories;

interface EventRepositoryInterface{
 
    public function getEvent($event);
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($event);
}