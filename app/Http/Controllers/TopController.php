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

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $companies = $this->companyService->getCompany(null, 'gr', 20);

            $conditions = $this->displayService->getConditionAll();
            $stacks = $this->displayService->getTechnologyAll();

            $schools = $this->schoolService->getSchool(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);
            
            return view('top', compact('user', 'companies', 'conditions', 'stacks', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('トップページでエラーが発生！');
            abort(404);
        }
    }

    public function go_refferrer(){
        return back();
    }
}
