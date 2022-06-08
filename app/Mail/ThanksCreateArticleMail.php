<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThanksCreateArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $user;

    public function __construct($article, $user)
    {
        $this->article = $article;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('記事のご登録ありがとうございます。')
            ->view('emails.thanks-create-article');
    }
}
