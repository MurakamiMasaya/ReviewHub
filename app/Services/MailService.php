<?php

namespace App\Services;

use App\Interfaces\Services\MailServiceInterface;
use App\Interfaces\Services\TokenServiceInterface;
use App\Jobs\SendContactMail;
use App\Jobs\SendCreateArticleMail;
use App\Jobs\SendCreateEventMail;
use App\Jobs\SendReportMail;
use App\Jobs\SendResetMail;
use App\Jobs\SendVerificationMail;
use App\Models\EmailReset;
use Illuminate\Support\Facades\Auth;

class MailService implements MailServiceInterface {

    private $tokenService;

    public function __construct(
        TokenServiceInterface $tokenService
        ) {
        $this->tokenService = $tokenService;
    }

    public function sendThanksCreateArticle($request, $user){

        $article = [
            'title' => $request->title,
            'contents' => $request->contents,
            'image' => $request->image,
            'tag' => $request->tag ?? null,
            'url' => $request->url ?? null,
        ];
        SendCreateArticleMail::dispatch($article, $user);
    }

    public function sendThanksCreateEvent($request, $user){

        $event = [
                'contact_address' => $request->contact_address,
                'contact_email' => $request->contact_email,
                'segment' => $request->segment === '1' ? '勉強会' : 'その他',
                'online' => $request->online === '1' ? 'オンライン' : null,
                'area' => $request->area ?? null,
                'capacity' => $request->capacity,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'title' => $request->title,
                'contents' => $request->contents,
                'image' => $request->image ?? null,
                'url' => $request->url ?? null,
                'tag' => $request->tag ?? null,
        ];
        SendCreateEventMail::dispatch($event, $user);
    }

    public function sendContact($request, $user){

        $contact = [
            'title' => $request->title,
            'contents' => $request->contents,
        ];
        SendContactMail::dispatch($contact, $user);
    }

    public function sendReport($request, $user){

        $report = [
            'type' => $request->type,
            'target_id' => $request->target_id ?? null,
            'review_id' => $request->review_id ?? null,
            'report' => $request->report ?? null,
            'report_other' => $request->report_other ?? null,
        ];
        SendReportMail::dispatch($report, $user);
    }

    public function sendResetMail($request){

        $email = $request->email;
        $token = $this->tokenService->createToken($email);
        $url = request()->getSchemeAndHttpHost(). '/mypage/reset/' . $token;

        SendResetMail::dispatch($email, $url);
    }


}