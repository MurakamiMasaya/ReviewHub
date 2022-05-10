<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\School;
use App\Models\Event;
use App\Models\Article;
use App\Models\Condition;
use App\Models\Stack;
use App\Interfaces\DisplayRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DisplayRepository implements DisplayRepositoryInterface {

    public function getAuthenticatedUser(){
        return Auth::user();
    }

    public function getTargetsThreeEach($models){
        if($models==='Company'){
            return Company::orderBy('gr', 'desc')->limit(3)->get();
        }
        if($models==='School'){
            return School::orderBy('gr', 'desc')->limit(3)->get();
        }
    }

    public function getTargetsTenEach($models){
        if($models==='Event'){
            return Event::orderBy('gr', 'desc')->paginate(10); 
        }
        if($models==='Article'){
            return Article::orderBy('gr', 'desc')->paginate(10); 
        }
    }

    public function getTargetsTwelveEach($models){
        if($models==='Company'){
            return Company::orderBy('gr', 'desc')->paginate(20); 
        }
        if($models==='School'){
            return School::orderBy('gr', 'desc')->paginate(20); 
        }
    }

    public function getArticlesEightEach(){
        return Article::orderBy('gr', 'desc')->limit(8)->get();
    }

    public function getTechnologyAll(){
        return Stack::all();
    }

    public function getConditionAll(){
        return Condition::all();
    }
}