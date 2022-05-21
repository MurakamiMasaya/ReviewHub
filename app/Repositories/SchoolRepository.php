<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SchoolRepositoryInterface;
use App\Models\ReviewSchool;
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

    public function getReviewsTenEach($school){
        return ReviewSchool::with('user', 'school')->where('school_id', $school)->orderBy('gr', 'desc')->paginate(10);
    }

    public function getReviewsTiedUserTenEach($user){
        return ReviewSchool::with('user', 'school')->where('user_id', $user)->orderBy('gr', 'desc')->paginate(10); 
    }

    public function deleteReview($id){
        return ReviewSchool::where('id', $id)->delete();
    }
}