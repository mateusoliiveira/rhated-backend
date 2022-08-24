<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('guests')
        ->group(function () {
            Route::post('login', 'login');
            Route::controller(UserController::class)
                ->group(function () {
                    Route::post('register', 'store');
            });
    });

    Route::controller(AuthController::class)
        ->prefix('users')
        ->middleware('auth:api')
        ->group(function () {
            Route::get('me', 'me');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
    });

    Route::controller(PublicationController::class)
        ->prefix('publications')
        ->group(function () {
            //expec: find all
            Route::get('', 'index');
            //expec: find one
            Route::get('{id}', 'show');
            //expec: store one
            Route::post('', 'store');
            //expec: delete one
            Route::delete('{id}', 'destroy');
    });

    Route::controller(FollowController::class)
        ->prefix('follows')
        ->group(function () {
            //expec: store one
            Route::post('', 'store');
            //expec: delete one
            Route::delete('{id}', 'destroy');
    });
});

