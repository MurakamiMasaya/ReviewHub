<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Models\Article;
use App\Models\ReviewArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
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
        $articles = $this->articleService->getTenEach();

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();
    
        return view('article.index', compact('user', 'articles', 'companies', 'schools'));
    }

    public function search(Request $request){

        $user = $this->displayService->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $articlesSearch = $this->articleService->getSearchTenEach($target);
        $articlesAll = $this->articleService->getSearchAll($target);

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();
            
        return view('article.candidates', compact('user', 'target', 'articlesSearch', 'articlesAll', 'companies', 'schools'));
    }

    public function detail(Request $request, $article){

        $user = $this->displayService->getAuthenticatedUser();

        $articleData = $this->articleService->getArticle($article);
        $reviewArticles = $this->articleService->getReviews($article);

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();

        return view('article.detail', compact('user', 'articleData', 'reviewArticles', 'companies', 'schools'));
    }
}
