<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
use App\Http\Requests\SearchRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Models\CompanyGr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index($period = 'all'){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $period = $this->displayService->judgePeriod($period);
            $companies = $this->companyService->getCompany(null, 'gr', $period, 20);
            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.index', compact('user', 'companies', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページのトップでエラーが発生！');
            abort(404);
        }
    }

    public function search(SearchRequest $request){

        try{
            // #TODO: 文字入力なしでの検索をバリデーションで禁止にする
            $user = $this->displayService->getAuthenticatedUser();
            
            // ＃TODO: 大文字小文字全角半角を区別しないように修正
            $target = htmlspecialchars($request->target);
            $companies = $this->companyService->searchCompany($target, 'name', 'gr', 20);
            $AllCompanies = $this->companyService->searchCompany($target, 'name', 'gr');

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.candidates', compact('user', 'target', 'companies', 'AllCompanies', 'schools', 'articles')); 

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページの検索でエラーが発生！');
            abort(404);
        }
    }

    public function tech(Request $request, $target){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $companies = $this->companyService->searchCompany($target, 'technology', 'gr', 20);
            $AllCompanies = $this->companyService->searchCompany($target, 'technology', 'gr');
            
            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.candidates', compact('user', 'target', 'companies', 'AllCompanies', 'schools', 'articles')); 

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページの技術検索でエラーが発生！');
            abort(404);
        }
    }

    public function condition(Request $request, $target){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $companies = $this->companyService->searchCompany($target, 'condition', 'gr', 20);
            $AllCompanies = $this->companyService->searchCompany($target, 'condition', 'gr');
            
            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.candidates', compact('user', 'target', 'companies', 'AllCompanies', 'schools', 'articles')); 

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページの採用条件検索でエラーが発生！');
            abort(404);
        }
    }

    public function detail(Request $request, $company){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $companyData = $this->companyService->getCompany($company);
            $reviews = $this->companyService->getReview($company, 'company_id', 'gr', 10);

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.detail', compact('user', 'companyData', 'reviews', 'schools', 'articles'));
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページの詳細画面でエラーが発生！');
            abort(404);
        }
    }

    public function review($detail){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $company = $this->companyService->getCompany($detail);

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.review', compact('user', 'company', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページのレビュー作成でエラーが発生！');
            abort(404);
        }
    }

    public function confilmReview(ReviewFormRequest $request, $company){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $company = $this->companyService->getCompany($company);

            $review = $request->review;

            $schools = $this->schoolService->getSchool(null, 'gr', 30, null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', 30, null, 8);

            return view('company.confilm', compact('user', 'company', 'review', 'schools', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページのレビュー確認でエラーが発生！');
            abort(404);
        }
    }

    public function registerReview(ReviewFormRequest $request, $company){

        try{
            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                return redirect()->route('company.review', $company)->withInput();
            }

            $this->companyService->createReview($request);

            $text = '投稿が完了しました！';
            $linkText = '企業一覧に戻る';
            $link = 'company.index';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページのレビュー登録でエラーが発生！');
            abort(404);
        }
    }

    public function deleteReview(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->companyService->deleteReview($request->id);

            return redirect()->route('mypage.review');

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業ページのレビュー削除でエラーが発生！');
            abort(404);
        }
    }

    public function gr($id){

        try{
            $this->companyService->createCompanyGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業へのいいねでエラーが発生！');
            abort(404);
        }
    }

    public function deleteGr($id){
        
        try{
            $this->companyService->deleteCompanyGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業へのいいねキャンセルでエラーが発生！');
            abort(404);
        }
    }

    public function grReview($id){

        try{
            $this->companyService->createCompanyReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業へのいいねでエラーが発生！');
            abort(404);
        }
    }

    public function deleteGrReview($id){

        try{
            $this->companyService->deleteCompanyReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('企業レビューへのいいね削除でエラーが発生！');
            abort(404);
        }
    }
}
