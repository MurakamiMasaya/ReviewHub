<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use Illuminate\Http\Request;

class TopController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
    }

    public function index(){

        $user = $this->displayService->getAuthenticatedUser();
        $companies = $this->companyService->getTwelveEach(); 

        $conditions = $this->displayService->getConditionAll();
        $stacks = $this->displayService->getTechnologyAll();

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();
        
        return view('top', compact('user', 'companies', 'conditions', 'stacks', 'schools', 'articles'));
    }

    public function go_refferrer(){
        return back();
    }
}
