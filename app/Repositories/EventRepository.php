<?php

namespace App\Repositories;

use App\Interfaces\Repositories\EventRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\ReviewEvent;

class EventRepository implements EventRepositoryInterface {

    public function getEvent($event){
        return Event::findOrFail($event);
    }

    public function getTenEach(){
        return Event::orderBy('gr', 'desc')->paginate(10); 
    }

    public function getSearchTenEach($target){
        return Event::where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return Event::where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }

    public function getReviews($event){
        return ReviewEvent::where('event_id', $event)->orderBy('gr', 'desc')->paginate(10);
    }

}