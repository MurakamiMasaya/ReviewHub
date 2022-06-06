<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThanksCreateEventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $user;

    public function __construct($event, $user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('イベントのご登録ありがとうございます。')
            ->view('emails.thanks-create-event');
    }
}
