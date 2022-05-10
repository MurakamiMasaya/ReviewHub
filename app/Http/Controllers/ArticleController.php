<?php

namespace App\Http\Controllers;

use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use Illuminate\Http\Request;

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
}
