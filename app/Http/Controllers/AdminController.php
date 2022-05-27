<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;
    private $eventService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService,
        EventServiceInterface $eventService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
        $this->eventService = $eventService;
    }

    public function showCompany(){

        $user = $this->displayService->getAuthenticatedUser();

        $companies = $this->companyService->getCompany(null, 'created_at', 12, null);
        
        return view('admin.company', compact('companies', 'user'));
        
    }

    public function searchCompany(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $companies = $this->companyService->searchCompany($request->target, 'name', 'updated_at', 20, null);
        
        return view('admin.company', compact('companies', 'user'));
    }

    public function showSchool(){
        dd('スクール一覧の取得');
    }

    public function showEvent(){
        dd('イベント一覧の取得');
    }

    public function showArticle(){
        dd('記事一覧の取得');
    }

    public function showUser(){
        dd('ユーザ一覧の取得');
    }
}
