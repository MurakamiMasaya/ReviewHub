<?php

namespace App\Services;

use App\Interfaces\Repositories\RankingRepositoryInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\RankingServiceInterface;
use Illuminate\Support\Facades\Auth;

class RankingService implements RankingServiceInterface {

    private $rankingRepository;
    private $displayService;

    public function __construct(
        RankingRepositoryInterface $rankingRepository,
        DisplayServiceInterface $displayService
        ) {
        $this->rankingRepository = $rankingRepository;
        $this->displayService = $displayService;
    }

    public function createTotalGr(){

        $this->rankingRepository->createTotalGr();
        $this->rankingRepository->createTotalMonthGr();
        $this->rankingRepository->createTotalYearGr();
    }

    public function calculateRankingUser($period = 'all'){

        return  $this->rankingRepository->calculateRankingUser($period);
    }

    public function getRanking($period = 'all', $sort = 'total_gr', $paginate = '20'){

        return  $this->rankingRepository->getRanking($period, $sort, $paginate);
    }
}