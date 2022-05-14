<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use App\Models\Event;
use App\Models\ReviewEvent;
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

    public function detail(Request $request, $event){

        $user = $this->displayRepository->getAuthenticatedUser();

        $eventData = Event::where('id', $event)->first();
        $reviewEvents = ReviewEvent::where('event_id', $event)->orderBy('gr', 'desc')->paginate(10);

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        // dd($eventData, $reviewEvents);
        return view('event.detail', compact('user', 'eventData', 'reviewEvents', 'schools', 'articles'));
    }

    public function showRegister(){

        $user = $this->displayRepository->getAuthenticatedUser();

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('event.register' ,compact('user', 'schools', 'articles'));
    }

    public function confilmRegister(EventFormRequest $request){
        dd('バリデーション突破です。おめでとう！');
    }
    public function completeRegister(){
        dd('イベント登録完了です');
    }
}
