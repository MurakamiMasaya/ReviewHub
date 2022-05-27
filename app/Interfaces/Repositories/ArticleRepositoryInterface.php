<?php

namespace App\Interfaces\Repositories;

interface ArticleRepositoryInterface{
    
    public function getArticle($target, $column, $order, $paginate, $limit);
    public function searchArticle($target, $column, $order, $paginate, $limit);
    
    public function createReview($request);
    public function getReviews($target, $column, $order, $paginate, $limit);
    public function deleteReview($id);

    public function createArticle($request, $image);
    public function deleteArticle($article);
}