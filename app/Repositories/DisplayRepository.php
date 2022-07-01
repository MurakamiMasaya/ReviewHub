<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\School;
use App\Models\Event;
use App\Models\Article;
use App\Models\Condition;
use App\Models\Stack;
use App\Models\Contact;
use App\Models\User;
use App\Models\ReviewReport;
use App\Interfaces\Repositories\DisplayRepositoryInterface;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DisplayRepository implements DisplayRepositoryInterface {

    public function getAuthenticatedUser(){
        return Auth::user();
    }

    public function getUsers(){
        return User::with('events', 'articles')->orderby('created_at', 'desc')->paginate(20);
    }

    public function searchUser($target, $sort){
        return User::with('events', 'articles')->where('username', 'like', '%'. $target .'%')->orWhere('name', 'like', '%'. $target .'%')->orderby($sort, 'desc')->paginate(20);
    }

    public function getTechnologyAll(){
        return Stack::all();
    }

    public function getConditionAll(){
        return Condition::all();
    }

    public function createContact($request){
        Contact::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'contents' => $request->contents
        ]);
    }
    
    public function deleteAcount($id){
        return User::where('id', $id)->delete();
    }

    public function createReport($request){
        Report::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'target_id' => $request->target_id,
            'report' => $request->report,
            'report_orther' => $request->other ?? '',
        ]);
    }

    public function createReviewReport($request){
        ReviewReport::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'review_id' => $request->review_id,
            'report' => $request->report,
            'report_orther' => $request->other ?? '',
         ]);
    }

    public function getUser($id){
        return User::where('id', $id)->first();
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        $user->delete();
    }

}