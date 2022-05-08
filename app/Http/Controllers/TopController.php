<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Condition;
use App\Models\School;
use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index(){

        $user = Auth::user();
        $companies = Company::orderBy('gr', 'desc')
            ->paginate(20);
        $conditions = Condition::all();
        $stacks = Stack::all();
        $schools = School::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('gr', 'desc')
            ->limit(8)
            ->get();
        // dd($schools, $articles);
        
        return view('top', compact('user', 'companies', 'conditions', 'stacks', 'schools', 'articles'));
    }

    public function go_refferrer(){
        return back();
    }
}
