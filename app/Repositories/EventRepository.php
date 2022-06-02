<?php

namespace App\Repositories;

use App\Interfaces\Repositories\EventRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventGr;
use App\Models\EventReviewGr;
use App\Models\ReviewEvent;
use App\Models\ReviewEventGr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventRepository implements EventRepositoryInterface {

    public function getEvent($target, $column, $order, $paginate, $limit, $before){

        if($before){
            return Event::with('user', 'reviewEvents', 'grs')
                ->where($column, $target)
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        if(!is_null($target) && !is_null($column) && !is_null($order) && !is_null($paginate) ){
            return Event::with('user', 'reviewEvents', 'grs')
                ->where($column, $target)
                ->where('end_date', '>=', Carbon::now())
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        if(!is_null($target)){
            return Event::with('user', 'reviewEvents', 'grs')
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->findOrFail($target);
        }
        if(!is_null($order) && !is_null($paginate) ){
            return Event::with('user', 'reviewEvents', 'grs')
                ->where('end_date', '>=', Carbon::now())
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
    }

    public function searchEvent($target, $column, $order, $paginate, $limit){

        if(is_null($paginate) && is_null($limit)){
            return Event::with('user', 'reviewEvents', 'grs')
                ->where($column, 'like', '%'. $target . '%')
                ->where('end_date', '>=', Carbon::now())
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->orderBy($order, 'desc')
                ->get();
        }
        if(!is_null($paginate)){
            return Event::with('user', 'reviewEvents', 'grs')
                ->where($column, 'like', '%'. $target . '%')
                ->where('end_date', '>=', Carbon::now())
                ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
                ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
                ->groupBy('events.id')
                ->orderby($order, 'desc')
                ->paginate($paginate);
        }
        return Event::with('user', 'reviewEvents', 'grs')
            ->where($column, 'like', '%'. $target . '%')
            ->where('end_date', '>=', Carbon::now())
            ->leftJoin('event_grs', 'events.id', '=', 'event_grs.event_id')
            ->select('events.*', DB::raw("count(event_grs.event_id) as gr"))
            ->groupBy('events.id')
            ->orderby($order, 'desc')
            ->limit($limit)
            ->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){

        if(is_null($order) && is_null($paginate) && is_null($limit)){
            return ReviewEvent::with('user', 'event')
                ->where($column, $target)
                ->leftJoin('event_review_grs', 'review_events.id', '=', 'event_review_grs.review_event_id')
                ->select('review_events.*', DB::raw("count(event_review_grs.review_event_id) as gr"))
                ->groupBy('review_events.id')
                ->first(); 
        }
        if(is_null($paginate) && is_null($limit)){
            return ReviewEvent::with('user', 'event')
                ->where($column, $target)
                ->leftJoin('event_review_grs', 'review_events.id', '=', 'event_review_grs.review_event_id')
                ->select('review_events.*', DB::raw("count(event_review_grs.review_event_id) as gr"))
                ->groupBy('review_events.id')
                ->orderBy($order, 'desc')
                ->get(); 
        }
        if(!is_null($paginate)){
            return ReviewEvent::with('user', 'event')
                ->where($column, $target)
                ->leftJoin('event_review_grs', 'review_events.id', '=', 'event_review_grs.review_event_id')
                ->select('review_events.*', DB::raw("count(event_review_grs.review_event_id) as gr"))
                ->groupBy('review_events.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        return ReviewEvent::with('user', 'event')
            ->leftJoin('event_review_grs', 'review_events.id', '=', 'event_review_grs.review_event_id')
            ->select('review_events.*', DB::raw("count(event_review_grs.review_event_id) as gr"))
            ->groupBy('review_events.id')
            ->where($column, $target)
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get(); 
    }

    public function createEvent($request, $image){

        Event::create([
            'user_id' => $request->user_id,
            'contact_address' => $request->contact_address,
            'contact_email' => $request->contact_email,
            'segment' => $request->segment,
            'online' => $request->online ?? '',
            'area' => $request->area ?? '',
            'capacity' => $request->capacity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
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

    public function deleteReview($id){
        return ReviewEvent::where('id', $id)->delete();
    }

    public function deleteEvent($id){
        Event::where('id', $id)->delete();
    }

    public function createEventGr($id){
        EventGr::create([
            'user_id' => Auth::id(),
            'event_id' => $id
        ]);
    }

    public function deleteEventGr($id){
        $gr = EventGr::where('event_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }

    public function createEventReviewGr($id){
        EventReviewGr::create([
            'user_id' => Auth::id(),
            'review_event_id' => $id
        ]);
    }

    public function deleteEventReviewGr($id){
        $gr = EventReviewGr::where('event_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }

}