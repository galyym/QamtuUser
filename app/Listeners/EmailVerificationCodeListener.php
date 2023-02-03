<?php

namespace App\Listeners;

use App\Events\EmailVerificationCode;
use App\Mail\Auth\EmailVerifyCode;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailVerificationCodeListener
{
//    /**
//     * Create the event listener.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailVerificationCode  $event
     * @return void
     */
    public function handle(EmailVerificationCode $event)
    {

        Mail::to($event->email)->send(new EmailVerifyCode($event->verification_code));
    }
}
