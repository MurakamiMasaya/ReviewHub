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
        $companies = Company::orderBy('gr', 'desc')->paginate(20); 
        
        $schools = School::orderBy('gr', 'desc')->limit(3)->get();
        $articles = Article::orderBy('gr', 'desc')->limit(8)->get();

        return view('company.index', compact('user', 'companies', 'schools', 'articles'));
    }

    public function search(Request $request){

        // #TODO: 文字入力なしでの検索をバリデーションで禁止にする
        $user = Auth::user();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $companiesSearch = Company::where('name' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        $companiesAll = Company::where('name' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->get();

        $schools = School::orderBy('gr', 'desc')->limit(3)->get();
        $articles = Article::orderBy('gr', 'desc')->limit(8)->get();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }
}
