<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SchoolReviewGr;
use Illuminate\Support\Facades\Auth;

class ReviewSchool extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'school_id',
        'review',
        'gr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function grs(){
        return $this->hasMany(SchoolReviewGr::class);
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
