<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\ReviewArticle;

class ArticleRepository implements ArticleRepositoryInterface {

    public function getArticle($article){
        return Article::with('user')->findOrFail($article);
    }

    public function getTopEight(){
        return Article::with('user')->orderBy('gr', 'desc')->limit(8)->get();
    }

    public function getTenEach(){
        return Article::with('user')->orderBy('gr', 'desc')->paginate(10); 
    }

    public function getSearchTenEach($target){
        return Article::with('user')->where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->paginate(10);
    }

    public function getSearchAll($target){
        return Article::with('user')->where('title' , 'like', '%'. $target .'%')
        ->orderBy('gr', 'desc')
        ->get();
    }

    public function getReviewsAll($article){
        return ReviewArticle::with('user', 'article')->where('article_id', $article)->orderBy('gr', 'desc')->get();
    }

    public function getReviewsTiedUserTenEach($user){
        return ReviewArticle::with('user', 'article')->where('user_id', $user)->orderBy('gr', 'desc')->paginate(10);
    }

    public function getReviewsTenEach($article){
        return ReviewArticle::with('user', 'article')->where('article_id', $article)->orderBy('gr', 'desc')->paginate(10);
    }

    public function createArticle($request, $image){
        Article::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'contents' => $request->contents,
            'image' => $image ?? '',
            'url' => $request->url ?? '',
            'tag' => $request->tag ?? '',
        ]);
    }

    public function createReview($request){
        ReviewArticle::create([
            'user_id' => $request->user_id,
            'article_id' => $request->article_id,
            'review' => $request->review,
        ]);
    }

    public function deleteReview($id){
        ReviewArticle::where('id', $id)->delete();
    }
}