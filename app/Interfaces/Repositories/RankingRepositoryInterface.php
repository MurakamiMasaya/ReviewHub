<?php

namespace App\Interfaces\Repositories;

interface RankingRepositoryInterface{

    public function createTotalGr();
    public function createTotalMonthGr();
    public function createTotalYearGr();

    public function calculateRankingUser($period);
    public function getRanking($period, $sort, $paginate);
}