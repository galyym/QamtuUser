<?php

namespace App\Listeners;

use App\Events\PhoneVerificationCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class PhoneVerificationCodeListerner
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
    public function handle(PhoneVerificationCode $event)
    {
        $data = [
            'login' => (string)config('auth.smsc_login'),
            'psw' => (string)config('auth.smsc_password'),
            'phones' => (string)$event->phone,
            'mes' => "Ваш код: " . $event->verification_code
        ];

        $sendCode = Http::get("https://smsc.kz/sys/send.php", $data);
        if ($sendCode->status() !== 200) {
            \Log::info($sendCode);
        }
    }
}
