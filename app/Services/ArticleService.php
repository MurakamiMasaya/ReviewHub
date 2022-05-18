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

    public function getReviews($article){
        return $this->articleRepository->getReviews($aritcle);
    }
}