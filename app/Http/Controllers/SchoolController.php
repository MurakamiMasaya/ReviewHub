<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
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

        try{
            $user = $this->displayService->getAuthenticatedUser();
            // #TODO: クエリビルダで取得したデータに順位をつけたい。
            $schools = $this->schoolService->getSchool(null, 'gr', 20);
            
            $companies = $this->companyService->getCompany(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);

            return view('school.index', compact('user', 'schools', 'companies', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールのトップでエラーが発生！');
            abort(404);
        }
    }

    public function search(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $target = $request->input('target');

            // ＃TODO: 大文字小文字全角半角を区別しないように修正
            $schools = $this->schoolService->searchSchool($target, 'name', 'gr', 20);
            $allSchools = $this->schoolService->searchSchool($target, 'name', 'gr');

            $companies = $this->companyService->getCompany(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);

            return view('school.candidates', compact('user', 'target', 'schools', 'allSchools', 'companies', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールの検索でエラーが発生！');
            abort(404);
        }
    }

    public function detail(Request $request, $school){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $schoolData = $this->schoolService->getSchool($school);
            $reviews = $this->schoolService->getReview($school, 'school_id', 'gr', 10);

            $companies = $this->companyService->getCompany(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);

            // dd($reviewCompanies);
            return view('school.detail', compact('user', 'schoolData', 'reviews', 'companies', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールの詳細画面でエラーが発生！');
            abort(404);
        }
    }

    public function review($detail){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $school = $this->schoolService->getSchool($detail);

            $companies = $this->companyService->getCompany(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);

            return view('school.review', compact('user', 'school', 'companies', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールのレビュー投稿でエラーが発生！');
            abort(404);
        }
    }

    public function confilmReview(ReviewFormRequest $request, $school){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $school = $this->schoolService->getSchool($school);

            $review = $request->review;

            $companies = $this->companyService->getCompany(null, 'gr', null, 3);
            $articles = $this->articleService->getArticle(null, null, 'gr', null, 8);
            
            return view('school.confilm', compact('user', 'school', 'review', 'companies', 'articles'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールのレビュー確認でエラーが発生！');
            abort(404);
        }
    }

    public function registerReview(ReviewFormRequest $request, $school){

        try{       
            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                return redirect()->route('school.review', $school)->withInput();
            }

            $this->schoolService->createReview($request);

            $text = '投稿が完了しました！';
            $linkText = 'スクール一覧に戻る';
            $link = 'school.index';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールのレビュー登録でエラーが発生！');
            abort(404);
        }
    }

    public function deleteReview($id){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->schoolService->deleteReview($id);

            return redirect()->route('mypage.review');

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールのレビュー削除でエラーが発生！');
            abort(404);
        }
    }

    public function gr($id){

        try{
            $this->schoolService->createSchoolGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールへのいいねでエラーが発生！');
            abort(404);
        }
    }

    public function deleteGr($id){
        
        try{
            $this->schoolService->deleteSchoolGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールへのいいねキャンセルでエラーが発生！');
            abort(404);
        }
    }

    public function grReview($id){

        try{
            $this->schoolService->createSchoolReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールへのいいねでエラーが発生！');
            abort(404);
        }
    }

    public function deleteGrReview($id){

        try{
            $this->schoolService->deleteSchoolReviewGr($id);

            return redirect()->back();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('スクールレビューへのいいね削除でエラーが発生！');
            abort(404);
        }
    }
}
