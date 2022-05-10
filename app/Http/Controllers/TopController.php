<?php

namespace App\Http\Controllers;

use App\Interfaces\DisplayRepositoryInterface;
use Illuminate\Http\Request;

class TopController extends Controller
{
    private $displayRepository;

    public function __construct(
        DisplayRepositoryInterface $displayRepository
        ) {
        $this->displayRepository = $displayRepository;
    }

    public function index(){

        $user = $this->displayRepository->getAuthenticatedUser();
        $companies = $this->displayRepository->getTargetsTwelveEach('Company'); 

        $conditions = $this->displayRepository->getConditionAll();
        $stacks = $this->displayRepository->getTechnologyAll();

        $schools = $this->displayRepository->getTargetsThreeEach('School');
        $articles = $this->displayRepository->getArticlesEightEach();
        // dd($schools, $articles);
        
        return view('top', compact('user', 'companies', 'conditions', 'stacks', 'schools', 'articles'));
    }

    public function go_refferrer(){
        return back();
    }
}
