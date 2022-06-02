<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\ArticleGr;
use App\Models\ArticleReviewGr;
use App\Models\ReviewArticle;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface {

    public function getArticle($target, $column, $order, $paginate, $limit){

        if(!is_null($target) && !is_null($column) && !is_null($order) && !is_null($paginate) ){
            return Article::with('user', 'reviewArticles', 'grs')
                ->where($column, $target)
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        if(!is_null($target)){
            return Article::with('user', 'reviewArticles', 'grs')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->findOrFail($target);
        }
        if(!is_null($order) && !is_null($paginate) ){
            return Article::with('user', 'reviewArticles', 'grs')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        return Article::with('user', 'reviewArticles', 'grs')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderBy($order, 'desc')
                ->limit($limit)->get(); 
    }

    public function searchArticle($target, $column, $order, $paginate, $limit){

        if(is_null($paginate) && is_null($limit)){
            return Article::where($column, 'like', '%'. $target . '%')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderby($order, 'desc')->get();
        }
        if(!is_null($paginate)){
            return Article::where($column, 'like', '%'. $target . '%')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderby($order, 'desc')
                ->paginate($paginate);
        }
        return Article::where($column, 'like', '%'. $target . '%')
                ->leftJoin('article_grs', 'articles.id', '=', 'article_grs.article_id')
                ->select('articles.*', DB::raw("count(article_grs.article_id) as gr"))
                ->groupBy('articles.id')
                ->orderby($order, 'desc')
                ->limit($limit)
                ->get();
    }

    public function getReview($target, $column, $order, $paginate, $limit){

        if(is_null($order) && is_null($paginate) && is_null($limit)){
            return ReviewArticle::with('user', 'article')
                ->where($column, $target)
                ->leftJoin('article_review_grs', 'review_articles.id', '=', 'article_review_grs.review_article_id')
                ->select('review_articles.*', DB::raw("count(article_review_grs.review_article_id) as gr"))
                ->groupBy('review_articles.id')
                ->orderby($order, 'desc')
                ->first(); 
        }
        if(is_null($paginate) && is_null($limit)){
            return ReviewArticle::with('user', 'article')
                ->where($column, $target)
                ->leftJoin('article_review_grs', 'review_articles.id', '=', 'article_review_grs.review_article_id')
                ->select('review_articles.*', DB::raw("count(article_review_grs.review_article_id) as gr"))
                ->groupBy('review_articles.id')
                ->orderBy($order, 'desc')
                ->get(); 
        }
        if(!is_null($paginate)){
            return ReviewArticle::with('user', 'article')
                ->where($column, $target)
                ->leftJoin('article_review_grs', 'review_articles.id', '=', 'article_review_grs.review_article_id')
                ->select('review_articles.*', DB::raw("count(article_review_grs.review_article_id) as gr"))
                ->groupBy('review_articles.id')
                ->orderBy($order, 'desc')
                ->paginate($paginate); 
        }
        return ReviewArticle::with('user', 'article')
            ->where($column, $target)
            ->leftJoin('article_review_grs', 'review_articles.id', '=', 'article_review_grs.review_article_id')
            ->select('review_articles.*', DB::raw("count(article_review_grs.review_article_id) as gr"))
            ->groupBy('review_articles.id')
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get(); 
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

    public function createArticleGr($id){
        ArticleGr::create([
            'user_id' => Auth::id(),
            'article_id' => $id
        ]);
    }

    public function deleteArticleGr($id){
        $gr = ArticleGr::where('article_id', $id)->where('user_id', Auth::id())->first();
        $gr->delete();
    }

    public function createArticleReviewGr($id){
        ArticleReviewGr::create([
            'user_id' => Auth::id(),
            'review_article_id' => $id
        ]);
    }

    public function deleteArticleReviewGr($id){
        $gr = ArticleReviewGr::where('article_id', $id)->where('user_id', Auth::id())->first();
    }
}