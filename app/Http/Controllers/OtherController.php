<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Models\Contact;
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

        $user = $this->displayService->getAuthenticatedUser();

        return view('sitemap', compact('user'));
    }

    public function contact(){
        
        $user = $this->displayService->getAuthenticatedUser();

        return view('contact.index', compact('user'));
    }

    public function confilmContact(ContactFormRequest $request){
        
        $user = $this->displayService->getAuthenticatedUser();

        $contact = [
            'title' => $request->title,
            'contents' => $request->contents
        ];

        return view('contact.confilm', compact('user', 'contact'));
    }

    public function registContact(ContactFormRequest $request){

        $user = $this->displayService->getAuthenticatedUser();

        // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
        if ($request->back === "true") {
            return redirect()->route('contact')->withInput();
        }

        Contact::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'contents' => $request->contents
        ]);

        //以下に管理者へのメール送信を実装

        $text = 'お問い合わせ完了です！';
        $linkText = 'トップページに戻る';
        $link = 'top';
        
        return view('redirect', compact('text', 'linkText', 'link'));
    }
}
