<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\CompanyGr;
use App\Models\CompanyReviewGr;
use App\Models\ReviewCompany;

class CompanyRepository implements CompanyRepositoryInterface {

    public function getCompany($target, $order, $paginate, $limit){
        if(!is_null($target)){
            return Company::findOrFail($target);
        }
        if(!is_null($paginate)){
            return Company::orderBy($order, 'desc')->paginate($paginate); 
        }
        return Company::orderBy($order, 'desc')->limit($limit)->get();
    }
    
    public function searchCompany($target, $column, $order, $paginate, $limit){
        
        if(is_null($paginate) && is_null($limit)){

            return Company::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->get();
        }
        if(!is_null($paginate)){

            return Company::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->paginate($paginate);
        }
        return Company::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->limit($limit)->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){

        if(is_null($order) && is_null($paginate) && is_null($limit)){

            return ReviewCompany::with('user', 'company')->where($column, $target)->first(); 
        }
        if(is_null($paginate) && is_null($limit)){

            return ReviewCompany::with('user', 'company')->where($column, $target)->orderBy($order, 'desc')->get(); 
        }
        if(!is_null($paginate)){

            return ReviewCompany::with('user', 'company')->where($column, $target)->orderBy($order, 'desc')->paginate($paginate); 
        }
        return ReviewCompany::with('user', 'company')->where($column, $target)->orderBy($order, 'desc')->limit($limit)->get(); 
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

    public function createCompany($request){
        
        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'condition' => $request->condition ?? '',
            'technology' => $request->technology ?? '',
            'website_url' => $request->website_url,
        ]);
    }

    public function deleteCompany($id){
        return Company::where('id', $id)->delete();
    }

    public function createCompanyGr($id){
        CompanyGr::create([
            'user_id' => Auth::id(),
            'company_id' => $id
        ]);
    }

    public function deleteCompanyGr($id){
        $gr = CompanyGr::where('company_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }

    public function createCompanyReviewGr($id){
        CompanyReviewGr::create([
            'user_id' => Auth::id(),
            'review_company_id' => $id
        ]);
    }

    public function deleteCompanyReviewGr($id){
        $gr = CompanyReviewGr::where('company_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }
}