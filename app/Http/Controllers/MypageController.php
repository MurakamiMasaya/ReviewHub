<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
    }

    public function index(){
        $user = $this->displayService->getAuthenticatedUser();

        return view('mypage.index', compact('user'));
    }

    public function review(){

        $user = $this->displayService->getAuthenticatedUser();

        //ユーザーに紐づくすべてのreviewを取得
        $allReviews = $this->displayService->getAllReviews($user->id);

        return view('mypage.review', compact('allReviews'));
    }
}
