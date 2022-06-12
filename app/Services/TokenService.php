<?php

namespace App\Services;

use App\Interfaces\Repositories\TokenRepositoryInterface;
use App\Interfaces\Services\TokenServiceInterface;
use App\Models\Token;
use DateTime;
use Illuminate\Support\Facades\Auth;

class TokenService implements TokenServiceInterface {

    private $tokenRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
        ) {
        $this->tokenRepository = $tokenRepository;
    }

    public function createToken($email){

        $now = new DateTime();
        $now->format("Y-m-d H:i:s");

        $expire_at = $now->modify('+30 minutes');

        $token = uniqid(rand().'_'); 

        $this->tokenRepository->createToken($token, $email, $expire_at);

        return $token;
    }

    public function matchToken($token)
    {
        $now = new DateTime();

        $data = $this->tokenRepository->getCertificationToken($token);

        if(is_null($data)){
            return "WRONG";
        }

        $expire_date = new DateTime($data->expire_at);

        if($now < $expire_date){
            return "OK";
        }else{
            return "EXPIRE";
        }

    }

    public function getCertificationToken($token){
        return $this->tokenRepository->getCertificationToken($token);
    }

    public function deleteToken($token){
        $this->tokenRepository->deleteToken($token);
    }
}