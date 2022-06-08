<?php

namespace App\Services;

use App\Interfaces\Services\TokenServiceInterface;
use App\Models\Token;
use DateTime;
use Illuminate\Support\Facades\Auth;

class TokenService implements TokenServiceInterface {

    public function createToken($request){

        $email = $request->email;
        $now = new DateTime();
        $now->format("Y-m-d H:i:s");
        //有効期限を計算(30分とした)
        $expire_at = $now->modify('+30 minutes');
    
        //トークンを生成
        $token = uniqid('', true);
        //3. トークンをDBに保存
        Token::create([
            'token' => $token,
            'email' => $email,
            'expire_at' => $expire_at
        ]);

        return $token;
    }
}