<?php

namespace App\Interfaces\Services;

interface ArticleServiceInterface{
    
    public function getArticle($target, $column = null, $order = null, $paginate = null, $limit = null);
    public function searchArticle($target, $column, $order, $paginate = null, $limit = null);

    public function createReview($request);
    public function getReviews($target, $column, $order, $paginate = null, $limit = null);
    public function deleteReview($id);

    public function createArticle($request, $image);
    public function deleteArticle($article);
}