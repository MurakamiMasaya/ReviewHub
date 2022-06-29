<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ReviewEvent;
use App\Models\SchoolGr;
use Illuminate\Support\Facades\Auth;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        // 'address',
        // 'phone',
        'gr',
        'website_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewSchools()
    {
        return $this->hasMany(ReviewSchool::class);
    }

    public function grs(){
        return $this->hasMany(SchoolGr::class);
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
