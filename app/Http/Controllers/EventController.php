<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use App\Interfaces\ImageRepositoryInterface;
use App\Models\Event;
use App\Models\ReviewEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    private $searchRepository;
    private $displayRepository;
    private $imageRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository,
        DisplayRepositoryInterface $displayRepository,
        ImageRepositoryInterface $imageRepository
        ) {
        $this->searchRepository = $searchRepository;
        $this->displayRepository = $displayRepository;
        $this->imageRepository = $imageRepository;
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

        $user = $this->displayRepository->getAuthenticatedUser();

        //画像の一時保存
        if($image = $request->image){
            $fileNameToStore = $this->imageRepository->TemporarilySave($image, 'events');
        }
       
        //送信されたデータの取得
        $eventInfo = [
            'user_id' => $request->user_id,
            'username' => $request->username,
            'gender' => $request->gender,
            'contact_address' => $request->contact_address,
            'contact_email' => $request->contact_email,
            'segment' => $request->segment,
            'online' => $request->online,
            'area' => $request->area,
            'capacity' => $request->capacity,
            'title' => $request->title,
            'contents' => $request->contents,
            'image' => $fileNameToStore ?? '',
            'url' => $request->url,
            'tag' => $request->tag,
        ];

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('event.confilm', compact('user', 'eventInfo', 'schools', 'articles'));
    }

    public function completeRegister(EventFormRequest $request){
        // dd($request);

        // 戻るボタンが押された場合
        if ($request->back === true) {
            Storage::delete('public/events/tmp/'.$request->image);
            return redirect()->route('event.register')->withInput();
        }

        //画像の登録
        $image = $request->image;
        if(!is_null($image)){
            $fileNameToStore = $this->imageRepository->upload($image, 'events');
        }

        //イベントの作成
        Event::create([
            'user_id' => $request->user_id,
            'contact_address' => $request->contact_address,
            'contact_email' => $request->contact_email,
            'segment' => $request->segment,
            'online' => $request->online ?? '',
            'area' => $request->area ?? '',
            'capacity' => $request->capacity,
            'title' => $request->title,
            'contents' => $request->contents,
            'image' => $image ?? '',
            'url' => $request->url ?? '',
            'tag' => $request->tag ?? '',
        ]);

        $text = '登録が完了しました！';
        $linkText = 'イベント一覧に戻る';
        $link = 'event.index';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }
}
