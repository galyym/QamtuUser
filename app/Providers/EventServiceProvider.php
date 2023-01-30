<?php

namespace App\Providers;

use App\Events\CallVerification;
use App\Events\EmailVerificationCode;
use App\Events\PhoneVerificationCode;
use App\Listeners\CallVerificationCodeListener;
use App\Listeners\EmailVerificationCodeListener;
use App\Listeners\PhoneVerificationCodeListerner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EmailVerificationCode::class => [
            EmailVerificationCodeListener::class,
        ],

        PhoneVerificationCode::class => [
            PhoneVerificationCodeListerner::class,
        ],

        CallVerification::class => [
            CallVerificationCodeListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
