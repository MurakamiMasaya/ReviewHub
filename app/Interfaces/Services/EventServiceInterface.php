<?php

namespace App\Interfaces\Services;

interface EventServiceInterface{
 
    public function getEvent($event);
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($event);
}