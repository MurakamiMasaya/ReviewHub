<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\ReportFormRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\MailServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use App\Models\ReviewReport;
use Illuminate\Http\Request;

class OtherController extends Controller
{

    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;
    private $eventService;
    private $mailService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService,
        EventServiceInterface $eventService,
        MailServiceInterface $mailService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
        $this->eventService = $eventService;
        $this->mailService = $mailService;
    }

    public function sitemap(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            return view('sitemap', compact('user'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('サイトマップでエラーが発生！');
            abort(404);
        }
    }

    public function contact(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            return view('contact.index', compact('user'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('お問い合わせ画面でエラーが発生！');
            abort(404);
        }
    }

    public function confilmContact(ContactFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $contact = [
                'title' => $request->title,
                'contents' => $request->contents
            ];

            return view('contact.confilm', compact('user', 'contact'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('お問い合わせ確認でエラーが発生！');
            abort(404);
        }
    }

    public function registContact(ContactFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                return redirect()->route('contact')->withInput();
            }

            //以下に管理者へのメール送信を実装
            $this->mailService->sendContact($request, $user);

            $this->displayService->createContact($request);

            $text = 'お問い合わせ完了です！';
            $linkText = 'トップページに戻る';
            $link = 'top';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('お問い合わせの送信でエラーが発生！');
            abort(404);
        }
    }

    public function createReviewReport(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $type = $request->type;

            if($type === '企業'){
                $reviewDetail = $this->companyService->getReview($request->review_id, 'id');
                $route = 'company.detail';
                $para = $reviewDetail->company->id;
                $text = '企業詳細に戻る';
            }
            if($type === 'スクール'){
                $reviewDetail = $this->schoolService->getReview($request->review_id, 'id');
                $route = 'school.detail';
                $para = $reviewDetail->school->id;
                $text = 'スクール詳細に戻る';
            }
            if($type === 'イベント'){
                $reviewDetail = $this->eventService->getReview($request->review_id, 'id');
                $route = 'event.detail';
                $para = $reviewDetail->event->id;
                $text = 'イベント詳細に戻る';
            }
            if($type === '記事'){
                $reviewDetail = $this->articleService->getReview($request->review_id, 'id');
                $route = 'article.detail';
                $para = $reviewDetail->article->id;
                $text = '記事詳細に戻る';
            }

            return view('report.review-index', compact('user', 'reviewDetail', 'type', 'route', 'para', 'text'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('通報フォーム画面でエラーが発生！');
            abort(404);
        }
    }

    public function postReviewReport(ReportFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->displayService->createReviewReport($request);
            
            // 管理者に通報内容をメール
            $this->mailService->sendReport($request, $user);

            \Slack::channel('report')->send($request->type.'レビューに関する通報がありました！');

            $text = '通報が完了しました！';
            $linkText = 'トップページに戻る';
            $link = 'top';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('通報でエラーが発生！');
            abort(404);
        }
    }

    public function createReport(Request $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();
            $type = $request->type;

            if($type === 'イベント'){
                $targetDetail = $this->eventService->getEvent($request->target_id);
                $route = 'event.detail';
                $para = $targetDetail->id;
                $text = 'イベント詳細に戻る';
            }
            if($type === '記事'){
                $targetDetail = $this->articleService->getArticle($request->target_id);
                $route = 'article.detail';
                $para = $targetDetail->id;
                $text = '記事詳細に戻る';
            }

            return view('report.index', compact('user', 'targetDetail', 'type', 'route', 'para', 'text'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('通報フォーム画面でエラーが発生！');
            abort(404);
        }
    }

    public function postReport(ReportFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $this->displayService->createReport($request);
            
            // 管理者に通報内容をメール
            $this->mailService->sendReport($request, $user);

            \Slack::channel('report')->send($request->type.'に関する通報がありました！');

            $text = '通報が完了しました！';
            $linkText = 'トップページに戻る';
            $link = 'top';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('通報でエラーが発生！');
            abort(404);
        }
    }
}
