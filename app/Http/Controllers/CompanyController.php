<?php

namespace App\Http\Controllers;

use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $companies = $this->displayRepository->getTargetsTwelveEach('Company'); 
        
        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('company.index', compact('user', 'companies', 'schools', 'articles'));
    }

    public function search(Request $request){

        // #TODO: 文字入力なしでの検索をバリデーションで禁止にする
        $user = $this->displayRepository->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $companiesSearch = $this->searchRepository->getSearchTargetsTenEach('Company', 'name', $target);
        $companiesAll = $this->searchRepository->getSearchTargetsAll('Company', 'name', $target);

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }

    public function tech(Request $request, $target){
        
        $user = $this->displayRepository->getAuthenticatedUser();

        $companiesSearch = $this->searchRepository->getSearchTargetsTenEach('Company', 'technology', $target);
        $companiesAll = $this->searchRepository->getSearchTargetsAll('Company', 'technology', $target);
        
        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }

    public function condition(Request $request, $target){
        
        $user = $this->displayRepository->getAuthenticatedUser();

        $companiesSearch = $this->searchRepository->getSearchTargetsTenEach('Company', 'condition', $target);
        $companiesAll = $this->searchRepository->getSearchTargetsAll('Company', 'condition', $target);
        
        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('company.candidates', compact('user', 'target', 'companiesSearch', 'companiesAll', 'schools', 'articles')); 
    }
}
