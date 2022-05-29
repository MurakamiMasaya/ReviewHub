<?php

namespace App\Repositories;

use App\Interfaces\Repositories\EventRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\ReviewEvent;
use Carbon\Carbon;

class EventRepository implements EventRepositoryInterface {

    public function getEvent($target, $column, $order, $paginate, $limit, $before){

        if($before){
            return Event::with('user')->where($column, $target)->orderBy($order, 'desc')->paginate($paginate); 
        }
        if(!is_null($target) && !is_null($column) && !is_null($order) && !is_null($paginate) ){
            return Event::with('user')->where($column, $target)->where('end_date', '>=', Carbon::now())->orderBy($order, 'desc')->paginate($paginate); 
        }
        if(!is_null($target)){
            return Event::with('user')->findOrFail($target);
        }
        if(!is_null($order) && !is_null($paginate) ){
            return Event::with('user')->where('end_date', '>=', Carbon::now())->orderBy($order, 'desc')->paginate($paginate); 
        }
    }

    public function searchEvent($target, $column, $order, $paginate, $limit){

        if(is_null($paginate) && is_null($limit)){
            return Event::where($column, 'like', '%'. $target . '%')->where('end_date', '>=', Carbon::now())->orderby($order, 'desc')->get();
        }
        if(!is_null($paginate)){
            return Event::where($column, 'like', '%'. $target . '%')->where('end_date', '>=', Carbon::now())->orderby($order, 'desc')->paginate($paginate);
        }
        return Event::where($column, 'like', '%'. $target . '%')->where('end_date', '>=', Carbon::now())->orderby($order, 'desc')->limit($limit)->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){

        if(is_null($order) && is_null($paginate) && is_null($limit)){
            return ReviewEvent::with('user', 'event')->where($column, $target)->first(); 
        }
        if(is_null($paginate) && is_null($limit)){
            return ReviewEvent::with('user', 'event')->where($column, $target)->orderBy($order, 'desc')->get(); 
        }
        if(!is_null($paginate)){
            return ReviewEvent::with('user', 'event')->where($column, $target)->orderBy($order, 'desc')->paginate($paginate); 
        }
        return ReviewEvent::with('user', 'event')->where($column, $target)->orderBy($order, 'desc')->limit($limit)->get(); 
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

}