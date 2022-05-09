<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Company;
use App\Models\School;

class SchoolController extends Controller
{
    public function index(){
        $user = Auth::user();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $schools = School::orderBy('gr', 'desc')
            ->paginate(20); 
        
        $companies = Company::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('gr', 'desc')
            ->limit(8)
            ->get();

        return view('school.index', compact('user', 'schools', 'companies', 'articles'));
    }

    public function search(Request $request){

        $user = Auth::user();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $schoolsSearch = School::where('name' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        $schoolsAll = School::where('name' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->get();

        $companies = Company::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('gr', 'desc')
            ->limit(8)
            ->get();

        return view('school.candidates', compact('user', 'target', 'schoolsSearch', 'schoolsAll', 'companies', 'articles'));
    }
}
