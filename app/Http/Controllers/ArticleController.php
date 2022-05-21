<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
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
        $reviews = $this->articleService->getReviewsTenEach($article);
        $reviewsAll = $this->articleService->getReviewsAll($article);

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();

        return view('article.detail', compact('user', 'articleData', 'reviews', 'reviewsAll', 'companies', 'schools'));
    }

    public function showRegister(){

        $user = $this->displayService->getAuthenticatedUser();

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();

        return view('article.register' ,compact('user', 'companies', 'schools'));
    }

    public function confilmRegister(ArticleFormRequest $request){

        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg'],
        ]);

        $user = $this->displayService->getAuthenticatedUser();

        //画像の一時保存
        if($image = $request->image){
            $fileNameToStore = $this->imageService->TemporarilySave($image, 'articles');
        }
       
        //送信されたデータの取得
        $articleInfo = [
            'user_id' => $request->user_id,
            'username' => $request->username,
            'gender' => $request->gender,
            'title' => $request->title,
            'contents' => $request->contents,
            'image' => $fileNameToStore ?? '',
            'url' => $request->url,
            'tag' => $request->tag,
        ];

        //ログの出力
        Log::info($articleInfo);

        $companies = $this->companyService->getTopThree();
        $schools = $this->schoolService->getTopThree();

        return view('article.confilm', compact('user', 'articleInfo', 'companies', 'schools'));
    }

    public function completeRegister(ArticleFormRequest $request){
        $image = $request->image;

        // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
        if ($request->back === "true") {
            $this->imageService->delete('public/articles/tmp/', $image);
            return redirect()->route('article.register')->withInput();
        }

        //画像の登録
        if(!is_null($image)){
            $fileNameToStore = $this->imageService->upload($image, 'articles');
        }

        //イベントの作成
        $this->articleService->createArticle($request, $image);

        $text = '登録が完了しました！';
        $linkText = '記事一覧に戻る';
        $link = 'article.index';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }

    public function review(Request $request){
        
        $this->articleService->createReview($request);

        return redirect()->route('article.detail',$request->article_id);
    }

    public function deleteReview($id){

        $user = $this->displayService->getAuthenticatedUser();

        $this->articleService->deleteReview($id);

        return redirect()->route('mypage.review');
    }
}
