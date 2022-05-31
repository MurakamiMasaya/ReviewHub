<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleReviewGr;
use Illuminate\Support\Facades\Auth;

class ReviewArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'article_id',
        'review',
        'gr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function grs(){
        return $this->hasMany(ArticleReviewGr::class);
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
