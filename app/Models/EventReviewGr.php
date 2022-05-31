<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReviewEvent;

class EventReviewGr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_event_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviewEvent(){
        return $this->belongsTo(ReviewEvent::class);
    }
}
