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
use App\Models\ReviewReport;
use App\Models\CompanyGr;
use App\Models\CompanyReviewGr;
use App\Models\SchoolGr;
use App\Models\SchoolReviewGr;
use App\Models\EventGr;
use App\Models\EventReviewGr;
use App\Models\ArticleGr;
use App\Models\ArticleReviewGr;

class User extends Authenticatable implements MustVerifyEmail
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
        'admin_flg',
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

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function reports()
    {
        return $this->hasMany(ReviewReport::class);
    }

    public function companyGrs()
    {
        return $this->hasMany(CompanyGr::class);
    }

    public function companyReviewGrs()
    {
        return $this->hasMany(CompanyReviewGr::class);
    }

    public function schoolGrs()
    {
        return $this->hasMany(SchoolGr::class);
    }

    public function schoolReviewGrs()
    {
        return $this->hasMany(SchoolReviewGr::class);
    }

    public function eventGrs()
    {
        return $this->hasMany(EventGr::class);
    }

    public function eventReviewGrs()
    {
        return $this->hasMany(EventReviewGr::class);
    }

    public function articleGrs()
    {
        return $this->hasMany(ArticleGr::class);
    }

    public function articleReviewGrs()
    {
        return $this->hasMany(ArticleReviewGr::class);
    }
}
