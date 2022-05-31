<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReviewCompany;

class CompanyReviewGr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_company_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviewCompany(){
        return $this->belongsTo(ReviewCompany::class);
    }
}
