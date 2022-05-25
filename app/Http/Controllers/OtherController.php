<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Interfaces\Services\DisplayServiceInterface;
use Illuminate\Http\Request;

class OtherController extends Controller
{

    private $displayService;

    public function __construct(
        DisplayServiceInterface $displayService
        ) {
        $this->displayService = $displayService;
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

            $this->displayService->createContact($request);
            //以下に管理者へのメール送信を実装

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
}
