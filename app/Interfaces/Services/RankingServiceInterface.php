<?php

namespace App\Interfaces\Services;

interface RankingServiceInterface{
    
    public function createTotalGr();
    public function calculateRankingUser($period = 'all');
    public function getRanking($period = 'all', $sort = 'total_gr', $paginate = '50');
}