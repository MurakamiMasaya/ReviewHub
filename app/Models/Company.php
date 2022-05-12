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
        'company_name',
        'company_address',
        'company_phone',
        'company_technology',
        'company_gr',
        'company_website_url',
    ];

    public function reviewCompanies()
    {
        return $this->hasMany(ReviewCompany::class);
    }

}
