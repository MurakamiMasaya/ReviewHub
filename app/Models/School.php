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
        'name',
        'address',
        'phone',
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
}
