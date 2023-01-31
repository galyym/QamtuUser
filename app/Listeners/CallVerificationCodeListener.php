<?php

namespace App\Listeners;

use App\Events\CallVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CallVerificationCodeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CallVerification $event)
    {
        $data = [
            'login' => (string)config('auth.smsc_login'),
            'psw' => (string)config('auth.smsc_password'),
            'phone' => (string)$event->phone,
        ];

        $sendCode = Http::get("https://smsc.kz/sys/wait_call.php", $data);
        \Log::info($sendCode);
        if ($sendCode->status() !== 200) {
            \Log::info($sendCode);
        }
    }
}
