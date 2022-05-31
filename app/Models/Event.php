<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ReviewEvent;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'segment',
        'title',
        'contents',
        'image',
        'online',
        'area',
        'capacity',
        'start_date',
        'end_date',
        'contact_address',
        'contact_email',
        'gr',
        'tag',
        'url',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviewEvent(){
        return $this->hasMany(ReviewEvent::class);
    }

    public function grs(){
        return $this->hasMany(EventGr::class);
    }

    public function isGrByAuthUser(){

        $id = Auth::id();

        $grs = [];
        foreach($this->grs as $gr){
            array_push($grs, $gr->user_id);
        }
        if(in_array($id, $grs)){
            return true;
        }
        return false;
    }
    
}
