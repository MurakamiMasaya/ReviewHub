<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\School;
use App\Models\Article;

class EventController extends Controller
{
    public function index(){

        $user = Auth::user();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $events = Event::orderBy('gr', 'desc')
            ->paginate(20); 
        
        $schools = School::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('gr', 'desc')
            ->limit(8)
            ->get();
    
        // dd($companies);
        return view('event.index', compact('user', 'events', 'schools', 'articles'));
    }
}
