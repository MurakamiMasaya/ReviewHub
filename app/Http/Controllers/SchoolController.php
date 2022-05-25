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
            $schools = $this->schoolService->getTwelveEach();
            
            $companies = $this->companyService->getTopThree();
            $articles = $this->articleService->getTopEight();

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
            $schoolsSearch = $this->schoolService->getSearchTenEach($target);
            $schoolsAll = $this->schoolService->getSearchAll($target);

            $companies = $this->companyService->getTopThree();
            $articles = $this->articleService->getTopEight();

            return view('school.candidates', compact('user', 'target', 'schoolsSearch', 'schoolsAll', 'companies', 'articles'));

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
            $reviews = $this->schoolService->getReviewsTenEach($school);

            $companies = $this->companyService->getTopThree();
            $articles = $this->articleService->getTopEight();

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

            $companies = $this->companyService->getTopThree();
            $articles = $this->articleService->getTopEight();

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

            $companies = $this->companyService->getTopThree();
            $articles = $this->articleService->getTopEight();

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

            ReviewSchool::create([
                'user_id' => $request->user_id,
                'school_id' => $school,
                'review' => $request->review,
            ]);

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
}
