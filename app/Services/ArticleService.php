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

    public function getArticle($article){
        return $this->articleRepository->getArticle($article);
    }

    public function getTopEight(){
        return $this->articleRepository->getTopEight();
    }

    public function getTenEach(){
        return $this->articleRepository->getTenEach(); 
    }

    public function getSearchTenEach($target){
        return $this->articleRepository->getSearchTenEach($target);
    }

    public function getSearchAll($target){
        return $this->articleRepository->getSearchAll($target);
    }

    public function getReviewsAll($article){
        return $this->articleRepository->getReviewsAll($article);
    }

    public function getReviewsTenEach($article){
        return $this->articleRepository->getReviewsTenEach($article);
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
}