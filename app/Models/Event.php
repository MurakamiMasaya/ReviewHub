<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ReviewEvent;

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
        'contact_address',
        'contact_email',
        'gr',
        'tag',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewEvent()
    {
        return $this->hasMany(ReviewEvent::class);
    }
    
}
