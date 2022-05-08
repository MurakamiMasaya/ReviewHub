<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(){
        
        $user = Auth::user();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $articles = Article::orderBy('gr', 'desc')
            ->paginate(20); 
        
        $companies = Company::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $schools = School::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
    
        // dd($companies);
        return view('article.index', compact('user', 'articles', 'companies', 'schools'));
    }
}
