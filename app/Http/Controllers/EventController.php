<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\SearchRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\MailServiceInterface;
use App\Jobs\SendCreateEventMail;

class EventController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $eventService;
    private $displayService;
    private $imageService;
    private $mailService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        EventServiceInterface $eventService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService,
        MailServiceInterface $mailService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->eventService = $eventService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
        $this->mailService = $mailService;
    }

    public function index($period = 'month'){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            
            $period = $this->displayService->judgePeriod($period);
            $events = $this->eventService->getEvent(null, null, 'gr', $period, 10);
            
            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);
        
            return view('event.index', compact('user', 'events', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('?????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function search(SearchRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $target = $request->input('target');

            // ???TODO: ???????????????????????????????????????????????????????????????
            $events = $this->eventService->searchEvent($target, 'title', 'gr', 20);
            $AllEvents = $this->eventService->SearchEvent($target, 'title', 'gr');

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);
        
            return view('event.candidates', compact('user', 'target', 'events', 'AllEvents', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function detail(Request $request, $event){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $eventData = $this->eventService->getEvent($event);
            $reviews = $this->eventService->getReview($event, 'event_id', 'gr', 10);
            $AllReviews = $this->eventService->getReview($event, 'event_id', 'gr');

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('event.detail', compact('user', 'eventData', 'reviews', 'AllReviews', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function deleteEvent(Request $request){

        try{

            $this->eventService->deleteEvent($request->id);
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function createEvent(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('event.create' ,compact('user', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function confilmEvent(EventFormRequest $request){

        try{
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg'],
            ]);

            $user = $this->displayService->getAuthenticatedUser();

            //?????????????????????
            if($image = $request->image){
                $fileNameToStore = $this->imageService->TemporarilySave($image, 'events');
            }
        
            //?????????????????????????????????
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
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'title' => $request->title,
                'contents' => $request->contents,
                'image' => $fileNameToStore ?? '',
                'url' => $request->url,
                'tag' => $request->tag,
            ];

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('event.confilm', compact('user', 'eventInfo', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('????????????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function registEvent(EventFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $image = $request->image;

            // ????????????????????????????????????????????????????????????????????????????????????????????????????????????
            if ($request->back === "true") {
                $this->imageService->delete('public/events/tmp/', $image);
                return redirect()->route('event.register')->withInput();
            }

            //???????????????
            if(!is_null($image)){
                $fileNameToStore = $this->imageService->upload($image, 'events');
            }

            //???????????????????????????????????????????????????
            $this->mailService->sendThanksCreateEvent($request, $user);

            //?????????????????????
            $this->eventService->createEvent($request, $image);



            $text = '??????????????????????????????';
            $linkText = '???????????????????????????';
            $link = 'event.index';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function review(ReviewFormRequest $request){

        try{
            $this->eventService->createReview($request);

            return redirect()->route('event.detail',$request->event_id);
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function deleteReview(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->eventService->deleteReview($request->id);

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function gr($id){

        try{
            $this->eventService->createEventGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('???????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function deleteGr($id){
        
        try{
            $this->eventService->deleteEventGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('??????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function grReview($id){

        try{
            $this->eventService->createEventReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('???????????????????????????????????????????????????');
            abort(404);
        }
    }

    public function deleteGrReview($id){

        try{
            $this->eventService->deleteEventReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('?????????????????????????????????????????????????????????????????????');
            abort(404);
        }
    }
}
