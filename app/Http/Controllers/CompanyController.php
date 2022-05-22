<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewForm;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Models\ReviewCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
        $reviews = $this->companyService->getReviewsTenEach($company);

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.detail', compact('user', 'companyData', 'reviews', 'schools', 'articles'));
    }

    public function review($detail){

        $user = $this->displayService->getAuthenticatedUser();
        $company = $this->companyService->getCompany($detail);

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.review', compact('user', 'company', 'schools', 'articles'));
    }

    public function confilmReview(ReviewForm $request, $company){
        
        $user = $this->displayService->getAuthenticatedUser();
        $company = $this->companyService->getCompany($company);

        $review = $request->review;

        $schools = $this->schoolService->getTopThree();
        $articles = $this->articleService->getTopEight();

        return view('company.confilm', compact('user', 'company', 'review', 'schools', 'articles'));
    }

    public function registerReview(ReviewForm $request, $company){
       
        // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
        if ($request->back === "true") {
            return redirect()->route('company.review', $company)->withInput();
        }

        ReviewCompany::create([
            'user_id' => $request->user_id,
            'company_id' => $company,
            'review' => $request->review,
        ]);

        $text = '投稿が完了しました！';
        $linkText = '企業一覧に戻る';
        $link = 'company.index';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }

    public function deleteReview($id){

        $user = $this->displayService->getAuthenticatedUser();

        $this->companyService->deleteReview($id);

        return redirect()->route('mypage.review');
    }
}
