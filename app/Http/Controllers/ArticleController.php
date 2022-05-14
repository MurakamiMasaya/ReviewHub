<?php

namespace App\Http\Controllers;

use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use App\Models\Article;
use App\Models\ReviewArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    private $searchRepository;
    private $displayRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository,
        DisplayRepositoryInterface $displayRepository
        ) {
        $this->searchRepository = $searchRepository;
        $this->displayRepository = $displayRepository;
    }

    public function index(){
        
        $user = $this->displayRepository->getAuthenticatedUser();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $articles = $this->displayRepository->getTargetsTenEach('Article');

        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $schools = $this->displayRepository->getTargetsThreeEach('School');
    
        return view('article.index', compact('user', 'articles', 'companies', 'schools'));
    }

    public function search(Request $request){

        $user = $this->displayRepository->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $articlesSearch = $this->searchRepository->getSearchTargetsTenEach('Article', 'title', $target);
        $articlesAll = $this->searchRepository->getSearchTargetsAll('Article', 'title', $target);

        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $schools = $this->displayRepository->getTargetsThreeEach('School');
            
        return view('article.candidates', compact('user', 'target', 'articlesSearch', 'articlesAll', 'companies', 'schools'));
    }

    public function detail(Request $request, $article){

        $user = $this->displayRepository->getAuthenticatedUser();

        $articleData = Article::where('id', $article)->first();
        $reviewArticles = ReviewArticle::where('article_id', $article)->orderBy('gr', 'desc')->paginate(10);

        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $schools = $this->displayRepository->getTargetsThreeEach('School');

        // dd($articleData, $reviewArticles);
        return view('article.detail', compact('user', 'articleData', 'reviewArticles', 'companies', 'schools'));
    }
}
