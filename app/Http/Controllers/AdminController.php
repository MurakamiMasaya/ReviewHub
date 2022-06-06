<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Http\Requests\SchoolFormRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;
    private $eventService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService,
        EventServiceInterface $eventService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
        $this->eventService = $eventService;
    }

    public function showCompany(){

        $user = $this->displayService->getAuthenticatedUser();

        $companies = $this->companyService->getCompany(null, 'updated_at',null, 20, null);
        
        $target = '';
        $sort = 'updated_at';
        
        return view('admin.company.index', compact('companies', 'user', 'target', 'sort'));
        
    }

    public function searchCompany(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $target = $request->target ?? null;
        $sort = $request->sort ?? 'updated_at';

        $companies = $this->companyService->searchCompany($target, 'name', $sort, 20, null);
        
        return view('admin.company.index', compact('companies', 'user', 'target', 'sort'));
    }

    public function editCompany($company){

        $user = $this->displayService->getAuthenticatedUser();

        $company = $this->companyService->getCompany($company);

        return view('admin.company.edit', compact('company', 'user'));
    }

    public function confilmCompany(CompanyFormRequest $request){

        $user = $this->displayService->getAuthenticatedUser();

        $companyInfo = [
            'id' => $request->company_id ?? null,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'condition' => $request->condition,
            'technology' => $request->technology,
            'website_url' => $request->website_url,
        ];

        return view('admin.company.confilm', compact('companyInfo', 'user'));
    }

    public function registCompany(CompanyFormRequest $request){

        if ($request->back === "true") {
            return redirect()->route('admin.company.edit',['company' => $request->company_id])->withInput();
        }

        $user = $this->displayService->getAuthenticatedUser();

        if(is_null($request->company_id)){

            $this->companyService->createCompany($request);

            $text = '企業の新規登録が完了しました！';

        } else {
            
            $company = $this->companyService->getCompany($request->company_id);
            $company->name = $request->name;
            $company->address = $request->address;
            $company->phone = $request->phone;
            $company->condition = $request->condition ?? '';
            $company->technology = $request->technology ?? '';
            $company->website_url = $request->website_url;
            $company->save();
    
            $text = '企業の編集が完了しました！';
        }
        $linkText = '企業一覧に戻る';
        $link = 'admin.company';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }

    public function createCompany(){

        $user = $this->displayService->getAuthenticatedUser();

        return view('admin.company.create', compact('user'));
    }

    public function deleteCompany(Request $request){
        
        $this->companyService->deleteCompany($request->company_id);

        return redirect()->route('admin.company');
    }

    public function showSchool(){

        $user = $this->displayService->getAuthenticatedUser();

        $schools = $this->schoolService->getSchool(null, 'created_at', null, 20, null);

        $target = '';
        $sort = 'updated_at';
        
        return view('admin.school.index', compact('schools', 'user', 'target', 'sort'));
    }

    public function searchSchool(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $target = $request->target ?? null;
        $sort = $request->sort ?? 'updated_at';

        $schools = $this->schoolService->searchSchool($target, 'name', $sort, 20, null);
        
        return view('admin.school.index', compact('schools', 'user', 'target', 'sort'));
    }

    public function editSchool($school){

        $user = $this->displayService->getAuthenticatedUser();

        $school = $this->schoolService->getSchool($school);

        return view('admin.school.edit', compact('school', 'user'));
    }

    public function confilmSchool(SchoolFormRequest $request){

        $user = $this->displayService->getAuthenticatedUser();

        $schoolInfo = [
            'id' => $request->school_id ?? null,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'website_url' => $request->website_url,
        ];

        return view('admin.school.confilm', compact('schoolInfo', 'user'));
    }

    public function registSchool(SchoolFormRequest $request){

        if ($request->back === "true") {
            return redirect()->route('admin.school.edit',['school' => $request->school_id])->withInput();
        }

        $user = $this->displayService->getAuthenticatedUser();

        if(is_null($request->school_id)){

            $this->schoolService->createSchool($request);

            $text = 'スクールの新規登録が完了しました！';

        } else {
            
            $school = $this->schoolService->getSchool($request->school_id);
            $school->name = $request->name;
            $school->address = $request->address;
            $school->phone = $request->phone;  
            $school->website_url = $request->website_url;
            $school->save();
    
            $text = 'スクールの編集が完了しました！';
        }
        $linkText = 'スクール一覧に戻る';
        $link = 'admin.school';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }

    public function createSchool(){

        $user = $this->displayService->getAuthenticatedUser();

        return view('admin.school.create', compact('user'));
    }

    public function deleteSchool(Request $request){
        
        $this->schoolService->deleteSchool($request->school_id);

        return redirect()->route('admin.school');
    }
    

    public function showEvent(){

        $user = $this->displayService->getAuthenticatedUser();

        $events = $this->eventService->getEvent(null, null, 'created_at', null, 20, null);

        $target = '';
        $sort = 'updated_at';
        
        return view('admin.event.index', compact('events', 'user', 'target', 'sort'));
    }

    public function searchEvent(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $target = $request->target ?? null;
        $sort = $request->sort ?? 'updated_at';

        $events = $this->eventService->searchEvent($target, 'title', $sort, 20, null);
        
        return view('admin.event.index', compact('events', 'user', 'target', 'sort'));
    }

    public function confilmEvent($event){

        $user = $this->displayService->getAuthenticatedUser();

        $event = $this->eventService->getEvent($event);

        return view('admin.event.confilm', compact('event', 'user'));
    }

    public function deleteEvent(Request $request){
        
        $this->eventService->deleteEvent($request->event_id);

        return redirect()->route('admin.event');
    }

    public function showArticle(){

        $user = $this->displayService->getAuthenticatedUser();

        $articles = $this->articleService->getArticle(null, null, 'created_at', null, 20, null);

        $target = '';
        $sort = 'updated_at';
        
        return view('admin.article.index', compact('articles', 'user', 'target', 'sort'));
    }

    public function searchArticle(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $target = $request->target ?? null;
        $sort = $request->sort ?? 'updated_at';

        $articles = $this->articleService->searchArticle($target, 'title', $sort, 20, null);
        
        return view('admin.article.index', compact('articles', 'user', 'target', 'sort'));
    }

    public function confilmArticle($article){

        $user = $this->displayService->getAuthenticatedUser();

        $article = $this->articleService->getArticle($article);

        return view('admin.article.confilm', compact('article', 'user'));
    }

    public function deleteArticle(Request $request){
        
        $this->articleService->deleteArticle($request->article_id);

        return redirect()->route('admin.article');
    }

    public function showUser(){

        $user = $this->displayService->getAuthenticatedUser();

        $users = $this->displayService->getUser();

        $target = '';
        $sort = 'updated_at';
        
        return view('admin.user.index', compact('users', 'user', 'target', 'sort'));
    }

    public function searchUser(Request $request){

        $user = $this->displayService->getAuthenticatedUser();

        $target = $request->target ?? null;
        $sort = $request->sort ?? 'created_at';

        $users = $this->displayService->searchUser($target, $sort);
        
        return view('admin.user.index', compact('users', 'user', 'target', 'sort'));
    }

    public function confilmUser($article){

        $user = $this->displayService->getAuthenticatedUser();

        return view('admin.user.confilm', compact('user'));
    }

    public function deleteUser(Request $request){
        
        $this->userService->deleteUser($request->user_id);

        return redirect()->route('admin.user');
    }

}
