<?php

namespace App\Listeners;

use App\Events\EmailVerificationCode;
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
        Mail::send('welcome', [$event], function ($message) use ($event){
            $message->to($event->email)
                ->from($event->email, "Askar")
                ->subject($event->verification_code);
        });
    }
}
