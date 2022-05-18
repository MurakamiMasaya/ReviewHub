<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SchoolRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class SchoolRepository implements SchoolRepositoryInterface {

    public function getSchool($company){
        return School::findOrFail($company);
    }

    public function getTopThree(){
        return School::orderBy('gr', 'desc')->limit(3)->get();
    }

    public function getTwelveEach(){
        return School::orderBy('gr', 'desc')->paginate(20); 
    }

    public function getSearchTenEach($target){
        return School::where('name' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return School::where('name' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }
}