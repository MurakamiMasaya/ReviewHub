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
        return Socialite::driver('google')
            ->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        //ユーザー情報の確認
        // dd($googleUser);

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
    }
}

