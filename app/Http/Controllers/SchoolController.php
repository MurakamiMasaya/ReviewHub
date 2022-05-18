<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Models\ReviewSchool;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
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
        $schools = $this->schoolService->getTwelveEach();
        
        $companies = $this->companyService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('school.index', compact('user', 'schools', 'companies', 'articles'));
    }

    public function search(Request $request){

        $user = $this->displayService->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $schoolsSearch = $this->schoolService->getSearchTenEach($target);
        $schoolsAll = $this->schoolService->getSearchAll($target);

        $companies = $this->companyService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('school.candidates', compact('user', 'target', 'schoolsSearch', 'schoolsAll', 'companies', 'articles'));
    }

    public function detail(Request $request, $school){

        $user = $this->displayService->getAuthenticatedUser();

        $schoolData = $this->schoolService->getSchool($school);
        $reviews = ReviewSchool::where('school_id', $school)->orderBy('gr', 'desc')->paginate(10); 

        $companies = $this->companyService->getTopThree();
        $articles = $this->articleService->getTopEight();

        // dd($reviewCompanies);
        return view('school.detail', compact('user', 'schoolData', 'reviews', 'companies', 'articles'));
    }
}
