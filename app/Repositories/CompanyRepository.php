<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\ReviewCompany;

class CompanyRepository implements CompanyRepositoryInterface {

    public function getCompany($company){
        return Company::findOrFail($company);
    }

    public function getTopThree(){
        return Company::orderBy('gr', 'desc')->limit(3)->get();
    }

    public function getTwelveEach(){
        return Company::orderBy('gr', 'desc')->paginate(20); 
    }

    public function getSearchTenEach($target){
        return Company::where('name' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return Company::where('name' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }

    public function getReviews($company){
        return ReviewCompany::where('company_id', $company)->orderBy('gr', 'desc')->paginate(10); 
    }
}