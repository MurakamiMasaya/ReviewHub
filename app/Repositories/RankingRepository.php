<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RankingRepositoryInterface;
use App\Models\TotalGr;
use App\Models\TotalMonthGr;
use App\Models\TotalYearGr;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankingRepository implements RankingRepositoryInterface {
    
    public function createTotalGr(){
              
        $total_grs = User::withCount(['companyReviewGrs as company_review_gr', 'schoolReviewGrs as school_review_gr', 
            'eventReviewGrs as event_review_gr', 'articleReviewGrs as article_review_gr', 'eventGrs as event_gr', 'articleGrs as article_gr'])
            ->get();
        
        foreach($total_grs as $total_gr){
            $user = TotalGr::where('user_id', $total_gr->id)->first();
        
            if(isset($user)){
                $user->company_review_gr = $total_gr->company_review_gr;
                $user->school_review_gr = $total_gr->school_review_gr;
                $user->event_review_gr = $total_gr->event_review_gr;
                $user->article_review_gr = $total_gr->article_review_gr;
                $user->event_gr = $total_gr->event_gr;
                $user->article_gr = $total_gr->article_gr;
                $user->total_gr = $total_gr->company_review_gr + $total_gr->school_review_gr + $total_gr->event_review_gr
                + $total_gr->article_review_gr + $total_gr->event_gr + $total_gr->article_gr;
                $user->save();
            } else {
                TotalGr::create([
                    'user_id' => $total_gr->id,
                    'company_review_gr' => $total_gr->company_review_gr,
                    'school_review_gr' => $total_gr->school_review_gr,
                    'event_review_gr' => $total_gr->event_review_gr,
                    'article_review_gr' => $total_gr->article_review_gr,
                    'event_gr' => $total_gr->event_gr,
                    'article_gr' => $total_gr->article_gr,
                    'total_gr' => $total_gr->company_review_gr + $total_gr->school_review_gr + $total_gr->event_review_gr
                    + $total_gr->article_review_gr + $total_gr->event_gr + $total_gr->article_gr,
                ]);
            }
        }
    }

    public function createTotalMonthGr(){
              
        $total_m_grs = User::withCount(['companyReviewGrs as company_review_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->withCount(['schoolReviewGrs as school_review_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->withCount(['eventReviewGrs as event_review_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->withCount(['articleReviewGrs as article_review_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->withCount(['eventGrs as event_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->withCount(['articleGrs as article_gr' => function(Builder $query){
                $query->whereMonth('created_at', '=', date('m'));
            }])
            ->get();
        
        foreach($total_m_grs as $total_m_gr){
            $user = TotalMonthGr::where('user_id', $total_m_gr->id)->first();
        
            if(isset($user)){
                $user->company_review_gr = $total_m_gr->company_review_gr;
                $user->school_review_gr = $total_m_gr->school_review_gr;
                $user->event_review_gr = $total_m_gr->event_review_gr;
                $user->article_review_gr = $total_m_gr->article_review_gr;
                $user->event_gr = $total_m_gr->event_gr;
                $user->article_gr = $total_m_gr->article_gr;
                $user->total_gr = $total_m_gr->company_review_gr + $total_m_gr->school_review_gr + $total_m_gr->event_review_gr
                + $total_m_gr->article_review_gr + $total_m_gr->event_gr + $total_m_gr->article_gr;
                $user->save();
            } else {
                TotalMonthGr::create([
                    'user_id' => $total_m_gr->id,
                    'company_review_gr' => $total_m_gr->company_review_gr,
                    'school_review_gr' => $total_m_gr->school_review_gr,
                    'event_review_gr' => $total_m_gr->event_review_gr,
                    'article_review_gr' => $total_m_gr->article_review_gr,
                    'event_gr' => $total_m_gr->event_gr,
                    'article_gr' => $total_m_gr->article_gr,
                    'total_gr' => $total_m_gr->company_review_gr + $total_m_gr->school_review_gr + $total_m_gr->event_review_gr
                    + $total_m_gr->article_review_gr + $total_m_gr->event_gr + $total_m_gr->article_gr,
                ]);
            }
        }
    }

    public function createTotalYearGr(){
              
        $total_y_grs = User::withCount(['companyReviewGrs as company_review_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->withCount(['schoolReviewGrs as school_review_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->withCount(['eventReviewGrs as event_review_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->withCount(['articleReviewGrs as article_review_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->withCount(['eventGrs as event_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->withCount(['articleGrs as article_gr' => function(Builder $query){
                $query->whereYear('created_at', '=', date('Y'));
            }])
            ->get();
        
        foreach($total_y_grs as $total_y_gr){
            $user = TotalYearGr::where('user_id', $total_y_gr->id)->first();
        
            if(isset($user)){
                $user->company_review_gr = $total_y_gr->company_review_gr;
                $user->school_review_gr = $total_y_gr->school_review_gr;
                $user->event_review_gr = $total_y_gr->event_review_gr;
                $user->article_review_gr = $total_y_gr->article_review_gr;
                $user->event_gr = $total_y_gr->event_gr;
                $user->article_gr = $total_y_gr->article_gr;
                $user->total_gr = $total_y_gr->company_review_gr + $total_y_gr->school_review_gr + $total_y_gr->event_review_gr
                + $total_y_gr->article_review_gr + $total_y_gr->event_gr + $total_y_gr->article_gr;
                $user->save();
            } else {
                TotalYearGr::create([
                    'user_id' => $total_y_gr->id,
                    'company_review_gr' => $total_y_gr->company_review_gr,
                    'school_review_gr' => $total_y_gr->school_review_gr,
                    'event_review_gr' => $total_y_gr->event_review_gr,
                    'article_review_gr' => $total_y_gr->article_review_gr,
                    'event_gr' => $total_y_gr->event_gr,
                    'article_gr' => $total_y_gr->article_gr,
                    'total_gr' => $total_y_gr->company_review_gr + $total_y_gr->school_review_gr + $total_y_gr->event_review_gr
                    + $total_y_gr->article_review_gr + $total_y_gr->event_gr + $total_y_gr->article_gr,
                ]);
            }
        }
    }

    public function calculateRankingUser($period){

        if($period === 'all'){
            $total_grs = TotalGr::orderBy('total_gr', 'desc')->get();

            for($rank = 0;  $rank < count($total_grs); $rank++){
                if($total_grs[$rank]->user_id === Auth::id()){
                    return $rank + 1;
                }
            }
        }

        if($period === 'year'){
            $total_grs = TotalYearGr::orderBy('total_gr', 'desc')->get();
            
            for($rank = 0;  $rank < count($total_grs); $rank++){
                if($total_grs[$rank]->user_id === Auth::id()){
                    return $rank + 1;
                }
            }
        }

        if($period === 'month'){
            $total_grs = TotalMonthGr::orderBy('total_gr', 'desc')->get();
            
            for($rank = 0;  $rank < count($total_grs); $rank++){
                if($total_grs[$rank]->user_id === Auth::id()){
                    return $rank + 1;
                }
            }
        }
    }

    public function getRanking($period, $sort, $paginate){

        if($period === 'all'){
            return TotalGr::orderBy($sort, 'desc')->paginate($paginate);
        }

        if($period === 'year'){
            return TotalYearGr::orderBy($sort, 'desc')->paginate($paginate);
        }

        if($period === 'month'){
            return TotalMonthGr::orderBy($sort, 'desc')->paginate($paginate);
        }
    }
}