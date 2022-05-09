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
    
        return view('event.index', compact('user', 'events', 'schools', 'articles'));
    }

    public function search(Request $request){

        $user = Auth::user();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $eventsSearch = Event::where('title' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->paginate(10);
        $eventsAll = Event::where('title' , 'like', '%'.$request->input('target').'%')
            ->orderBy('gr', 'desc')
            ->get();

        $schools = School::orderBy('gr', 'desc')
            ->limit(3)
            ->get();
        $articles = Article::orderBy('gr', 'desc')
            ->limit(8)
            ->get();
    
        return view('event.candidates', compact('user', 'target', 'eventsSearch', 'eventsAll', 'schools', 'articles'));
    }
}
