<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\CompanyGr;
use App\Models\CompanyReviewGr;
use App\Models\ReviewCompany;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyRepositoryInterface {

    public function getCompany($target, $order, $period, $paginate, $limit){

        $days = Carbon::today()->subDay($period);

        if(!is_null($target)){
            return Company::findOrFail($target);
        }
        if(!is_null($paginate)){
            return Company::leftJoin('company_grs', 'companies.id', '=', 'company_grs.company_id')
            ->withCount(['grs as gr' => function(Builder $query) use($days){
                $query->where('created_at', '>=', $days);
            }])
            ->orderBy($order, 'desc')
            ->paginate($paginate); 
        }
        return Company::leftJoin('company_grs', 'companies.id', '=', 'company_grs.company_id')
            ->withCount(['grs as gr' => function(Builder $query) use($days){
                $query->where('created_at', '>=', $days);
            }])
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function searchCompany($target, $column, $order, $paginate, $limit){
        
        if(is_null($paginate) && is_null($limit)){

            return Company::where($column, 'like', '%'. $target . '%')
                ->leftJoin('company_grs', 'companies.id', '=', 'company_grs.company_id')
                ->select('companies.*', DB::raw("count(company_grs.company_id) as gr"))
                ->groupBy('companies.id')
                ->orderby($order, 'desc')
                ->get();
        }
        if(!is_null($paginate)){

            return Company::where($column, 'like', '%'. $target . '%')
                ->leftJoin('company_grs', 'companies.id', '=', 'company_grs.company_id')
                ->select('companies.*', DB::raw("count(company_grs.company_id) as gr"))
                ->groupBy('companies.id')
                ->orderby($order, 'desc')
                ->paginate($paginate);
        }
        return Company::where($column, 'like', '%'. $target . '%')
            ->leftJoin('company_grs', 'companies.id', '=', 'company_grs.company_id')
            ->select('companies.*', DB::raw("count(company_grs.company_id) as gr"))
            ->groupBy('companies.id')
            ->orderby($order, 'desc')
            ->limit($limit)
            ->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){
        
        if(is_null($order) && is_null($paginate) && is_null($limit)){

            return ReviewCompany::with('user', 'company')
                ->where($column, $target)
                ->first(); 
        }
        if(is_null($paginate) && is_null($limit)){

            return ReviewCompany::with('user', 'company')
                ->where($column, $target)
                ->leftJoin('company_review_grs', 'review_companies.id', '=', 'company_review_grs.review_company_id')
                ->select('review_companies.*', DB::raw("count(company_review_grs.review_company_id) as gr"))
                ->groupBy('review_companies.id')
                ->orderBy($order, 'desc')
                ->get(); 
        }
        if(!is_null($paginate)){

            return ReviewCompany::with('user', 'company')
                ->where($column, $target)
                ->leftJoin('company_review_grs', 'review_companies.id', '=', 'company_review_grs.review_company_id')
                ->select('review_companies.*', DB::raw("count(company_review_grs.review_company_id) as gr"))
                ->groupBy('review_companies.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        return ReviewCompany::with('user', 'company')
            ->where($column, $target)
            ->leftJoin('company_review_grs', 'review_companies.id', '=', 'company_review_grs.review_company_id')
            ->select('review_companies.*', DB::raw("count(company_review_grs.review_company_id) as gr"))
            ->groupBy('review_companies.id')
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get(); 
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