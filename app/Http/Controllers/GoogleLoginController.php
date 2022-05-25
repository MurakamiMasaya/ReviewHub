<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        try{
            return Socialite::driver('google')
                ->redirect();

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('Google認証でエラーが発生！');
            return redirect()->route('login')->with('flash_message', 'ログインに失敗しました');
        }
    }

    public function authGoogleCallback()
    {
        try{
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate([
                'email' => $googleUser->email
            ], [
                'name' => $googleUser->getName(),
                'username' => $googleUser->getNickName() ?? $googleUser->user['given_name'],
                'email_verified_at' => now(),
                'password' => \Hash::make(uniqid()),
            ]);

            Auth::login($user, true);
            return redirect()->route('top');
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('Google認証でエラーが発生！');
            return redirect()->route('login')->with('flash_message', 'ログインに失敗しました');
        }
    }
}

