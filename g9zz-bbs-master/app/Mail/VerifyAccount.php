<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = '验证邮件';
    public $userName = ' ';
    public $verifyUrl = '';
    public function __construct($subject,$userName,$verifyUrl)
    {
        $this->subject = $subject;
        $this->userName = $userName;
        $this->verifyUrl = $verifyUrl;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.verify.account')
            ->subject($this->subject)->with([
                'name' => $this->userName,
                'url' => $this->verifyUrl,
            ]);
    }
}
