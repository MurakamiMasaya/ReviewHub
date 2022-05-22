<?php

namespace App\Interfaces\Repositories;

interface ArticleRepositoryInterface{
    
    public function getArticle($article);
    public function getArticleTiedUserTenEach($user);
    public function getTopEight();
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviewsAll($article);
    public function getReviewsTenEach($article);
    public function getReviewsTiedUserTenEach($user);
    public function deleteReview($id);

    public function createArticle($request, $image);
    public function createReview($request);
    public function deleteArticle($article);
}