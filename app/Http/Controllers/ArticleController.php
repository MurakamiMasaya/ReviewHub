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
    
        return view('article.index', compact('user', 'articles', 'companies', 'schools'));
    }

    public function search(Request $request){

        $user = Auth::user();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $articlesSearch = article::where('title' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        $articlesAll = article::where('title' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->get();

        $companies = Company::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $schools = School::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
            
        return view('article.candidates', compact('user', 'target', 'articlesSearch', 'articlesAll', 'companies', 'schools'));
    }
}
