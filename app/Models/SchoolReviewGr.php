<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReviewSchool;

class SchoolReviewGr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_school_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviewSchool(){
        return $this->belongsTo(ReviewSchool::class);
    }

    
}
