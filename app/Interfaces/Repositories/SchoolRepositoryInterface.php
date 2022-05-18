<?php

namespace App\Interfaces\Repositories;

interface SchoolRepositoryInterface{

    public function getSchool($company);
    public function getTopThree();
    public function getTwelveEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);
}