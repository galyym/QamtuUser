<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\PhoneController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Announce\AnnounceController;

Route::get("git/update", function (){
    shell_exec('/usr/local/cpanel/3rdparty/lib/path-bin/git pull origin master > /dev/null');
});

Route::middleware("json.response")->group(function (){

    Route::group(['prefix' => '{lang?}', 'where' => ['lang' => 'kk|ru']], function (){

        Route::post("login/email", [EmailController::class, "login"]);
        Route::post("login/phone", [PhoneController::class, "login"]);

        Route::post("login/email/verify", [EmailController::class, "verifyCode"]);
        Route::post("login/phone/verify", [PhoneController::class, "verifyCode"]);
        Route::post("refresh", [AuthController::class, 'refreshToken']);

        Route::middleware("auth:api")->group(function(){
            Route::group(['prefix' => 'main'],function (){
                Route::get("user/status", [UserController::class, "getUserLog"]);
            });

            Route::group(['prefix' => 'announce'],function (){
                Route::get("list", [AnnounceController::class, "getAnnounceList"]);
                Route::get("list/{id}", [AnnounceController::class, "getAnnounceById"]);
            });

            Route::group(['prefix' => 'profile'],function (){
                Route::get('', [ProfileController::class, "getProfile"]);
            });

            Route::get("test", function(){
                dd("test");
            });
        });
    });
//
//    Route::get("user/status", [UserController::class, "getUserLog"]);

});




