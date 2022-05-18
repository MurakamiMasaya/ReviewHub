<?php

namespace App\Interfaces\Services;

interface SchoolServiceInterface{

    public function getSchool($company);
    public function getTopThree();
    public function getTwelveEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);
}