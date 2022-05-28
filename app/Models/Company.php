<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ReviewCompany;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'condition',
        'technology',
        'gr',
        'website_url',
    ];

    public function reviewCompanies()
    {
        return $this->hasMany(ReviewCompany::class);
    }

}
