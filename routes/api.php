<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\PhoneController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Announce\AnnounceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Auth\EcpController;
use App\Http\Controllers\User\LangController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Test;

Route::get("git/update", function (){
    shell_exec('/usr/local/cpanel/3rdparty/lib/path-bin/git pull origin master > /dev/null');
});



Route::middleware("json.response")->group(function (){
    Route::group(['prefix' => '{lang?}', 'where' => ['lang' => 'kk|ru']], function (){

        Route::post("login/email", [EmailController::class, "login"]);
        Route::post("login/phone", [PhoneController::class, "login"]);
        Route::post("login/notify", [AuthController::class, "login"]); // temp
        Route::post("login/ecp", [EcpController::class, "authEcp"]);

        Route::post("login/email/verify", [EmailController::class, "verifyCode"]);
        Route::post("login/phone/verify", [PhoneController::class, "verifyCode"]);
        Route::post("login/notify/verify", [AuthController::class, "verifyCode"]); // temp

        Route::post("refresh", [AuthController::class, 'refreshToken']);

        Route::group(['prefix' => 'announce'],function (){
            Route::get("list", [AnnounceController::class, "getAnnounceList"]);
            Route::get("list/{id}", [AnnounceController::class, "getAnnounceById"]);
        });

        Route::middleware("auth:api")->group(function(){
            // LogOut
            Route::get("logout", [AuthController::class, "logout"]);

            // Басты бет
            Route::group(['prefix' => 'main'],function (){
                Route::get("user/status", [UserController::class, "getUserLog"]);
            });
            // Жеке бас ақпараттары
            Route::group(['prefix' => 'profile'],function (){
                Route::get('user', [ProfileController::class, "getProfile"]);
            });

            // Смена языка
            Route::get("lang", [LangController::class, "getLang"]);
            Route::post("lang", [LangController::class, "setLang"]);

            // Push уведомления
            Route::get("notification", [NotificationController::class, "getNotification"]);
            Route::post("notification", [NotificationController::class, "setNotification"]);

            // Отправить заявку на центр занятости
            Route::post('send/applicant/center', []);
        });

        // Test
        Route::get("test", [Test::class, "test"]);

        // Check applicant
        Route::get("check/applicant", [UserController::class, 'checkApplicant']);

        // Applicant list without filter
        Route::get('user/list/without/status', [UserController::class, 'getUserList']);
    });
});




