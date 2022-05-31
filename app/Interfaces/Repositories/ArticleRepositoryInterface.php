<?php

namespace App\Interfaces\Repositories;

interface ArticleRepositoryInterface{
    
    public function getArticle($target, $column, $order, $paginate, $limit);
    public function searchArticle($target, $column, $order, $paginate, $limit);
    
    public function createReview($request);
    public function getReview($target, $column, $order, $paginate, $limit);
    public function deleteReview($id);

    public function createArticle($request, $image);
    public function deleteArticle($article);

    public function createArticleGr($id);
    public function deleteArticleGr($id);
    public function createArticleReviewGr($id);
    public function deleteArticleReviewGr($id);
}