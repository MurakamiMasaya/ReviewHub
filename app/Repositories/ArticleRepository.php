<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\ReviewArticle;

class ArticleRepository implements ArticleRepositoryInterface {

    public function getArticle($article){
        return Article::findOrFail($article);
    }

    public function getTopEight(){
        return Article::orderBy('gr', 'desc')->limit(8)->get();
    }

    public function getTenEach(){
        return Article::orderBy('gr', 'desc')->paginate(10); 
    }

    public function getSearchTenEach($target){
        return Article::where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return Article::where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }

    public function getReviews($article){
        return ReviewArticle::where('article_id', $article)->orderBy('gr', 'desc')->paginate(10);
    }
}