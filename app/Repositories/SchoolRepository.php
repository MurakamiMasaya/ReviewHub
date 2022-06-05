<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SchoolRepositoryInterface;
use App\Models\ReviewSchool;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\SchoolGr;
use App\Models\SchoolReviewGr;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SchoolRepository implements SchoolRepositoryInterface {

    public function getSchool($target, $order, $period, $paginate, $limit){

        $days = Carbon::today()->subDay($period);

        if(!is_null($target)){
            return School::findOrFail($target);
        }
        if(!is_null($paginate)){
            return School::leftJoin('school_grs', 'schools.id', '=', 'school_grs.school_id')
            ->withCount(['grs as gr' => function(Builder $query) use($days){
                $query->where('created_at', '>=', $days);
            }])
            ->orderBy($order, 'desc')
            ->orderBy($order, 'desc')
            ->paginate($paginate); 
        }
        return School::leftJoin('school_grs', 'schools.id', '=', 'school_grs.school_id')
            ->withCount(['grs as gr' => function(Builder $query) use($days){
                $query->where('created_at', '>=', $days);
            }])
            ->orderBy($order, 'desc')
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function searchSchool($target, $column, $order, $paginate, $limit){
        
        if(is_null($paginate) && is_null($limit)){
            return School::where($column, 'like', '%'. $target . '%')
                ->leftJoin('school_grs', 'schools.id', '=', 'school_grs.school_id')
                ->select('schools.*', DB::raw("count(school_grs.school_id) as gr"))
                ->groupBy('schools.id')
                ->orderby($order, 'desc')
                ->get();
        }
        if(!is_null($paginate)){
            return School::where($column, 'like', '%'. $target . '%')
                ->leftJoin('school_grs', 'schools.id', '=', 'school_grs.school_id')
                ->select('schools.*', DB::raw("count(school_grs.school_id) as gr"))
                ->groupBy('schools.id')
                ->orderby($order, 'desc')
                ->paginate($paginate);
        }
        return School::where($column, 'like', '%'. $target . '%')
            ->leftJoin('school_grs', 'schools.id', '=', 'school_grs.school_id')
            ->select('schools.*', DB::raw("count(school_grs.school_id) as gr"))
            ->groupBy('schools.id')
            ->orderby($order, 'desc')
            ->limit($limit)
            ->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){

        if(is_null($order) && is_null($paginate) && is_null($limit)){
            return ReviewSchool::with('user', 'school')
                ->where($column, $target)
                ->first(); 
        }
        if(is_null($paginate) && is_null($limit)){
            return ReviewSchool::with('user', 'school')
                ->where($column, $target)
                ->leftJoin('school_review_grs', 'review_schools.id', '=', 'school_review_grs.review_school_id')
                ->select('review_schools.*', DB::raw("count(school_review_grs.review_school_id) as gr"))
                ->groupBy('review_schools.id')
                ->orderBy($order, 'desc')
                ->get(); 
        }
        if(!is_null($paginate)){
            return ReviewSchool::with('user', 'school')
                ->where($column, $target)
                ->leftJoin('school_review_grs', 'review_schools.id', '=', 'school_review_grs.review_school_id')
                ->select('review_schools.*', DB::raw("count(school_review_grs.review_school_id) as gr"))
                ->groupBy('review_schools.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        return ReviewSchool::with('user', 'school')
            ->where($column, $target)
            ->leftJoin('school_review_grs', 'review_schools.id', '=', 'school_review_grs.review_school_id')
            ->select('review_schools.*', DB::raw("count(school_review_grs.review_school_id) as gr"))
            ->groupBy('review_schools.id')
            ->orderBy($order, 'desc')->limit($limit)->get(); 
    }

    public function createReview($request){
        ReviewSchool::create([
            'user_id' => $request->user_id,
            'school_id' => $request->school_id,
            'review' => $request->review,
        ]);
    }

    public function deleteReview($id){
        return ReviewSchool::where('id', $id)->delete();
    }

    public function createSchool($request){
        School::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'website_url' => $request->website_url,
        ]);
    }

    public function deleteSchool($id){
        return School::where('id', $id)->delete();
    }

    public function createSchoolGr($id){
        SchoolGr::create([
            'user_id' => Auth::id(),
            'school_id' => $id
        ]);
    }

    public function deleteSchoolGr($id){
        $gr = SchoolGr::where('school_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }

    public function createSchoolReviewGr($id){
        SchoolReviewGr::create([
            'user_id' => Auth::id(),
            'review_school_id' => $id
        ]);
    }

    public function deleteSchoolReviewGr($id){
        $gr = SchoolReviewGr::where('school_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }
}