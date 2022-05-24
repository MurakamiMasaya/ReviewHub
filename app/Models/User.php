<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Event;
use App\Models\Contact;
use App\Models\ReviewArticle;
use App\Models\ReviewCompany;
use App\Models\ReviewEvent;
use App\Models\ReviewSchool;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'birthday',
        'gender',
        'username',
        'email',
        'phone',
        'password',
        'admin_flg'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function reviewArticles()
    {
        return $this->hasMany(ReviewArticle::class);
    }

    public function reviewCompanies()
    {
        return $this->hasMany(ReviewCompany::class);
    }

    public function reviewEvents()
    {
        return $this->hasMany(ReviewEvent::class);
    }

    public function reviewSchools()
    {
        return $this->hasMany(ReviewSchool::class);
    }

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }
}
