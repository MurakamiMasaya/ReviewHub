<?php

namespace App\Interfaces\Services;

interface ArticleServiceInterface{
    
    public function getArticle($article);
    public function getTopEight();
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviewsAll($article);
    public function getReviewsTenEach($article);
    public function deleteReview($id);

    public function createArticle($request);
    public function createReview($request);
}