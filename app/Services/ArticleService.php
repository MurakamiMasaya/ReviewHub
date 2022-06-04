<?php

namespace App\Services;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticleService implements ArticleServiceInterface {

    private $articleRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository
        ) {
        $this->articleRepository = $articleRepository;
    }

    public function getArticle($target, $column = null, $order = null, $period = null, $paginate = null, $limit = null){
        return $this->articleRepository->getArticle($target, $column, $order, $period, $paginate, $limit);
    }

    public function searchArticle($target, $column, $order, $paginate = null, $limit = null){
        return $this->articleRepository->searchArticle($target, $column, $order, $paginate, $limit);
    }

    public function getReview($target, $column, $order = null, $paginate = null, $limit = null){
        return $this->articleRepository->getReview($target, $column, $order, $paginate, $limit);
    }

    public function createArticle($request, $image){
        return $this->articleRepository->createArticle($request, $image);
    }

    public function createReview($request){
        return $this->articleRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->articleRepository->deleteReview($id);
    }

    public function deleteArticle($article){
        return $this->articleRepository->deleteArticle($article);
    }

    public function createArticleGr($id){
        return $this->articleRepository->createArticleGr($id);
    }

    public function deleteArticleGr($id){
        return $this->articleRepository->deleteArticleGr($id);
    }

    public function createArticleReviewGr($id){
        return $this->articleRepository->createArticleReviewGr($id);
    }

    public function deleteArticleReviewGr($id){
        return $this->articleRepository->deleteArticleReviewGr($id);
    }
}