<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Models\ReviewCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $companies = $this->companyService->getTwelveEach(); 
        
        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.index', compact('user', 'companies', 'schools', 'articles'));
    }

    public function search(Request $request){

        // #TODO: 文字入力なしでの検索をバリデーションで禁止にする
        $user = $this->displayService->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $companiesSearch = $this->companyService->getSearchTenEach($target);
        $companiesAll = $this->companyService->getSearchAll($target);

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }

    public function tech(Request $request, $target){
        
        $user = $this->displayService->getAuthenticatedUser();

        $companiesSearch = $this->companyService->getSearchTenEach($target);
        $companiesAll = $this->companyService->getSearchAll($target);
        
        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }

    public function condition(Request $request, $target){
        
        $user = $this->displayService->getAuthenticatedUser();

        $companiesSearch = $this->companyService->getSearchTenEach($target);
        $companiesAll = $this->companyService->getSearchAll($target);
        
        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }

    public function detail(Request $request, $company){

        $user = $this->displayService->getAuthenticatedUser();

        $companyData = $this->companyService->getCompany($company);
        $reviews = $this->companyService->getReviews($company);

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.detail', compact('user', 'companyData', 'reviews', 'schools', 'articles'));
    }
}
