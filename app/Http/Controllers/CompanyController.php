<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(){

        $user = Auth::user();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $companies = Company::orderBy('company_gr', 'desc')
            ->paginate(20); 
        // $companies = DB::table('companies')
        // ->select( id,
        //  DB::raw(select 'rank_result' rank()over(order by company_gr desc) as rank_result));
        
        $schools = School::orderBy('school_gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('article_gr', 'desc')
            ->limit(8)
            ->get();
    
        // dd($companies);
        return view('company.index', compact('user', 'companies', 'schools', 'articles'));
    }
}
