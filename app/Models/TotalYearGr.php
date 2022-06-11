<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalYearGr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_review_gr',
        'school_review_gr',
        'event_review_gr',
        'article_review_gr',
        'event_gr',
        'article_gr',
        'total_gr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
