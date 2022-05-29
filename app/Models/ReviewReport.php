<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'review_id',
        'report',
        'report_other',
    ];

    protected $casts = [
        'report' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
