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
}
