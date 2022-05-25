<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;

class EventController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $eventService;
    private $displayService;
    private $imageService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        EventServiceInterface $eventService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->eventService = $eventService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
    }

    public function index(){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            // #TODO: クエリビルダで取得したデータに順位をつけたい。
            $events = $this->eventService->getTenEach();
            
            $schools = $this->schoolService->getTopThree();
            $articles = $this->articleService->getTopEight();
        
            return view('event.index', compact('user', 'events', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのトップでエラーが発生！');
            abort(404);
        }
    }

    public function search(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $target = $request->input('target');

            // ＃TODO: 大文字小文字全角半角を区別しないように修正
            $eventsSearch = $this->eventService->getSearchTenEach($target);
            $eventsAll = $this->eventService->getSearchAll($target);

            $schools = $this->schoolService->getTopThree();
            $articles = $this->articleService->getTopEight();
        
            return view('event.candidates', compact('user', 'target', 'eventsSearch', 'eventsAll', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページの検索でエラーが発生！');
            abort(404);
        }
    }

    public function detail(Request $request, $event){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $eventData = $this->eventService->getEvent($event);
            $reviews = $this->eventService->getReviewsTenEach($event);
            $reviewsAll = $this->eventService->getReviews($event);

            $schools = $this->schoolService->getTopThree();
            $articles = $this->articleService->getTopEight();

            return view('event.detail', compact('user', 'eventData', 'reviews', 'reviewsAll', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページの詳細画面でエラーが発生！');
            abort(404);
        }
    }

    public function deleteEvent($event){

        try{
            $this->eventService->deleteEvent($event);

            return redirect()->route('mypage.event');
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのイベント削除でエラーが発生！');
            abort(404);
        }
    }

    public function createEvent(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $schools = $this->schoolService->getTopThree();
            $articles = $this->articleService->getTopEight();

            return view('event.register' ,compact('user', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのイベント作成でエラーが発生！');
            abort(404);
        }
    }

    public function confilmEvent(EventFormRequest $request){

        try{
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg'],
            ]);

            $user = $this->displayService->getAuthenticatedUser();

            //画像の一時保存
            if($image = $request->image){
                $fileNameToStore = $this->imageService->TemporarilySave($image, 'events');
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

            //ログの出力
            Log::info($eventInfo);

            $schools = $this->schoolService->getTopThree();
            $articles = $this->articleService->getTopEight();

            return view('event.confilm', compact('user', 'eventInfo', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのイベント確認画面でエラーが発生！');
            abort(404);
        }
    }

    public function registEvent(EventFormRequest $request){

        try{
            $image = $request->image;

            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                $this->imageService->delete('public/events/tmp/', $image);
                return redirect()->route('event.register')->withInput();
            }

            //画像の登録
            if(!is_null($image)){
                $fileNameToStore = $this->imageService->upload($image, 'events');
            }

            //イベントの作成
            $this->eventService->createEvent($request, $image);

            $text = '登録が完了しました！';
            $linkText = 'イベント一覧に戻る';
            $link = 'event.index';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのイベント登録でエラーが発生！');
            abort(404);
        }
    }

    public function review(ReviewFormRequest $request){

        try{
            $this->eventService->createReview($request);

            return redirect()->route('event.detail',$request->event_id);
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのレビュー作成でエラーが発生！');
            abort(404);
        }
    }

    public function deleteReview($id){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->eventService->deleteReview($id);

            return redirect()->route('mypage.review');

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('イベントページのレビュー削除でエラーが発生！');
            abort(404);
        }
    }
}
