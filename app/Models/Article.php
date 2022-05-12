<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ReviewArticle;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'article_title',
        'article_contents',
        'article_image',
        'article_gr',
        'article_tag',
        'article_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewArticles()
    {
        return $this->hasMany(ReviewArticle::class);
    }
}
