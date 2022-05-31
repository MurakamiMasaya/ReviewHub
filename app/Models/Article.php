<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\user;
use App\Models\ArticleGr;
use App\Models\ReviewArticle;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'image',
        'gr',
        'tag',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewArticles()
    {
        return $this->hasMany(ReviewArticle::class);
    }

    public function grs(){
        return $this->hasMany(ArticleGr::class);
    }

    public function isGrByAuthUser(){

        $id = Auth::id();

        $grs = [];
        foreach($this->grs as $gr){
            array_push($grs, $gr->user_id);
        }
        if(in_array($id, $grs)){
            return true;
        }
        return false;
    }
}
