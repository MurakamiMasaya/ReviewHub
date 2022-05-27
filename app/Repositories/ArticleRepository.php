<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\ReviewArticle;

class ArticleRepository implements ArticleRepositoryInterface {

    public function getArticle($target, $column, $order, $paginate, $limit){

        if(!is_null($target) && !is_null($column) && !is_null($order) && !is_null($paginate) ){
            return Article::with('user')->where($column, $target)->orderBy($order, 'desc')->paginate($paginate); 
        }
        if(!is_null($target)){
            return Article::with('user')->findOrFail($target);
        }
        if(!is_null($order) && !is_null($paginate) ){
            return Article::with('user')->orderBy($order, 'desc')->paginate($paginate); 
        }
        return Article::with('user')->orderBy($order, 'desc')->limit($limit)->get(); 
    }

    public function searchArticle($target, $column, $order, $paginate, $limit){

        if(is_null($paginate) && is_null($limit)){
            return Article::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->get();
        }
        if(!is_null($paginate)){
            return Article::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->paginate($paginate);
        }
        return Article::where($column, 'like', '%'. $target . '%')->orderby($order, 'desc')->limit($limit)->get();
    }

    public function getReviews($target, $column, $order, $paginate, $limit){

        if(is_null($paginate) && is_null($limit)){
            return ReviewArticle::with('user', 'article')->where($column, $target)->orderBy($order, 'desc')->get(); 
        }
        if(!is_null($paginate)){
            return ReviewArticle::with('user', 'article')->where($column, $target)->orderBy($order, 'desc')->paginate($paginate); 
        }
        return ReviewArticle::with('user', 'article')->where($column, $target)->orderBy($order, 'desc')->limit($limit)->get(); 
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

    public function deleteArticle($article){
        Article::where('id', $article)->delete();
    }
}