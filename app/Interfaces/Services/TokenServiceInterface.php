<?php

namespace App\Interfaces\Services;

interface TokenServiceInterface{

    public function createToken($request);
    public function matchToken($token);
    public function getCertificationToken($token);
    public function deleteToken($token);
}