<?php

namespace App\Interfaces\Services;

interface MailServiceInterface{

    public function sendThanksCreateArticle($request, $user);
    public function sendThanksCreateEvent($request, $user);
    public function sendContact($request, $user);
    public function sendReport($request, $user);
    public function sendVerificationEmail($request);
}