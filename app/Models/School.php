<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ReviewEvent;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_name',
        'school_online',
        'school_address',
        'school_contents',
        'school_phone',
        'school_gr',
        'school_website_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewSchools()
    {
        return $this->hasMany(ReviewSchool::class);
    }
}
