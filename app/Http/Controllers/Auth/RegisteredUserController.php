<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Interfaces\Services\MailServiceInterface;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    private $mailService;

    public function __construct(
        MailServiceInterface $mailService
        ) {
        $this->mailService = $mailService;
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(UserFormRequest $request)
    {
        try{

            $user = User::create([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'auth_flg' => 0,
                'admin_flg' => 0
            ]);

            event(new Registered($user));
            \Slack::send($user->username.'さんが仮登録しました！');

            //メール送信完了画面へリダイレクト
            $text = '認証メールを送信しました。メールに記載されているURLからログインしてください';
            $linkText = 'トップページに戻る';
            $link = 'top';
            
            return view('redirect', compact('text', 'linkText', 'link'));
        
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('ユーザーの新規登録でエラーが発生！');
            return redirect()->route('register')->with('flash_message', '新規登録に失敗しました');
        }
    }
}
