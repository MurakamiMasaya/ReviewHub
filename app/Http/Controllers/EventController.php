<?php

namespace App\Http\Controllers;

use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $searchRepository;
    private $displayRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository,
        DisplayRepositoryInterface $displayRepository
        ) {
        $this->searchRepository = $searchRepository;
        $this->displayRepository = $displayRepository;
    }

    public function index(){

        $user = $this->displayRepository->getAuthenticatedUser();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $events = $this->displayRepository->getTargetsTenEach('Event');
        
        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();
    
        return view('event.index', compact('user', 'events', 'schools', 'articles'));
    }

    public function search(Request $request){

        $user = $this->displayRepository->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $eventsSearch = $this->searchRepository->getSearchTargetsTenEach('Event', 'title', $target);
        $eventsAll = $this->searchRepository->getSearchTargetsAll('Event', 'title', $target);

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();
    
        return view('event.candidates', compact('user', 'target', 'eventsSearch', 'eventsAll', 'schools', 'articles'));
    }
}
