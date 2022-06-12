<?php

namespace App\Interfaces\Repositories;

interface TokenRepositoryInterface{

    public function getCertificationToken($token);
    public function deleteToken($token);
    public function createToken($token, $email, $expire_at);
}