<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\RankingServiceInterface;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    private $displayService;
    private $rankingService;

    public function __construct(
        DisplayServiceInterface $displayService,
        RankingServiceInterface $rankingService
        ) {
        $this->displayService = $displayService;
        $this->rankingService = $rankingService;
    }

    public function index($period = 'month'){

        //ユーザーに紐づくレビューを全て取得
        $user = $this->displayService->getAuthenticatedUser();

        $this->rankingService->createTotalGr();

        $ranks = $this->rankingService->getRanking($period);

        return view('rank.index', compact('user', 'ranks'));
    }
}
