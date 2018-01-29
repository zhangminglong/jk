<?php

namespace App\Jobs;

use App\Mail\VerifyAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type;
    protected $user;
    protected $subject = '验证邮件';
    protected $userName = ' ';
    protected $verifyUrl = '';
    public function __construct($type,$user,$subject,$userName,$verifyUrl)
    {
        $this->type = $type;
        $this->user = $user;
        $this->subject = $subject;
        $this->userName = $userName;
        $this->verifyUrl = $verifyUrl;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        switch ($this->type){
            case 'verify_account':
                \Mail::to($this->user)->send(new VerifyAccount($this->subject,$this->userName,$this->verifyUrl));
                break;
        }
    }
}
