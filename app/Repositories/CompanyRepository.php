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

    public function getReviewsTenEach($company){
        return ReviewCompany::with('user', 'company')->where('company_id', $company)->orderBy('gr', 'desc')->paginate(10); 
    }

    public function getReviewsTiedUserTenEach($user){
        return ReviewCompany::with('user', 'company')->where('user_id', $user)->orderBy('gr', 'desc')->paginate(10); 
    }

    public function createReview($request){
        ReviewCompany::create([
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'review' => $request->review,
        ]);
    }

    public function deleteReview($id){
        return ReviewCompany::where('id', $id)->delete();
    }
}