<?php

namespace App\Repositories;

use App\Interfaces\Repositories\EventRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\ReviewEvent;

class EventRepository implements EventRepositoryInterface {

    public function getEvent($event){
        return Event::with('user')->findOrFail($event);
    }

    public function getTenEach(){
        return Event::with('user')->orderBy('gr', 'desc')->paginate(10); 
    }

    public function getSearchTenEach($target){
        return Event::with('user')->where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return Event::with('user')->where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }

    public function getReviews($event){
        return ReviewEvent::with('user', 'event')->where('event_id', $event)->orderBy('gr', 'desc')->get();
    }

    public function getReviewsTenEach($event){
        return ReviewEvent::with('user', 'event')->where('event_id', $event)->orderBy('gr', 'desc')->paginate(10);
    }

    public function createEvent($request){

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
    }

    public function createReview($request){
        
        ReviewEvent::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'review' => $request->review
        ]);
    }

}