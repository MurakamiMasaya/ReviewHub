<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\School;
use App\Models\Event;
use App\Models\Article;
use App\Models\Condition;
use App\Models\Stack;
use App\Interfaces\Repositories\DisplayRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DisplayRepository implements DisplayRepositoryInterface {

    public function getAuthenticatedUser(){
        return Auth::user();
    }

    public function getTechnologyAll(){
        return Stack::all();
    }

    public function getConditionAll(){
        return Condition::all();
    }

    public function deleteAcount($id){
        return User::where('id', $id)->delete();
    }
}