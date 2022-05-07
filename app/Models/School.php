<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
