<?php

namespace App\Interfaces\Repositories;

interface ArticleRepositoryInterface{
    
    public function getArticle($article);
    public function getTopEight();
    public function getTenEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($article);
}