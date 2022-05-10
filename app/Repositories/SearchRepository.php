<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\Company;
use App\Models\School;
use App\Models\Event;
use App\Models\Article;

class SearchRepository implements SearchRepositoryInterface {

    public function getSearchTargetsTenEach($model, $column, $target){
        if($model==='Company'){
            return Company::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        }
        if($model==='School'){
            return School::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        }
        if($model==='Event'){
            return Event::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        }
        if($model==='Article'){
            return Article::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        }
    }

    public function getSearchTargetsAll($model, $column, $target){
        if($model==='Company'){
            return Company::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->get();
        }
        if($model==='School'){
            return School::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->get();
        }
        if($model==='Event'){
            return Event::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->get();
        }
        if($model==='Article'){
            return Article::where($column , 'like', '%'. $target .'%')
            ->orderBy('gr', 'desc')
            ->get();
        }
    }
}