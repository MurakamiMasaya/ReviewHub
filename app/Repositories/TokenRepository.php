<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TokenRepositoryInterface;
use App\Models\Token;

class TokenRepository implements TokenRepositoryInterface {

    public function getCertificationToken($token){
       return Token::where('token', $token)->first();
    }

    public function deleteToken($token){
        Token::where('token', $token)->delete();
    }

    public function createToken($token, $email, $expire_at){
        Token::create([
            'token' => $token,
            'email' => $email,
            'expire_at' => $expire_at
        ]);
    }
}