<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

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

    Route::controller(BrandController::class)
        ->prefix('brands')
        ->group(function () {
            //expec: find all brands
            Route::get('', 'index');
            //expec: find all brands with cars
            Route::get('vehicles', 'indexWith');
            //expec: find one brand
            Route::get('{id}', 'show');
            //expec: find one brand with cars
            Route::get('{id}/vehicles', 'with');
            //expec: store one brand
            Route::post('', 'store');
            //expec: store one brand
            Route::post('bulk', 'insert');
            //expec: delete one brand
            Route::delete('{id}', 'destroy');
    });

    Route::controller(CategoryController::class)
        ->prefix('categories')
        ->group(function () {
            //expec: find all categories
            Route::get('', 'index');
            //expec: find all categories with cars
            Route::get('vehicles', 'indexWith');
            //expec: find one category
            Route::get('{id}', 'show');
            //expec: find one category with cars
            Route::get('{id}/vehicles', 'with');
            //expec: store one category
            Route::post('', 'store');
            //expec: store one category
            Route::post('bulk', 'insert');
            //expec: delete one category
            Route::delete('{id}', 'destroy');
    });

    Route::controller(VehicleController::class)
        ->prefix('vehicles')
        ->group(function () {
            //expec: find all vehicles
            Route::get('', 'index');
            //expec: find all brands with cars
            Route::get('{id}', 'show');
            //expec: store one vehicle
            Route::post('', 'store');
            //expec: store one category
            Route::post('bulk', 'insert');
            //expec: delete one vehicle
            Route::delete('{id}', 'destroy');
    });

    Route::controller(OfferController::class)
        ->prefix('offers')
        ->group(function () {
            //expec: find all offers
            Route::get('', 'index');
            //expec: find all offers from an user
            Route::post('', 'store');
            //expec: delete one offer
            Route::delete('{id}', 'destroy');
            ///////////////////////////////////////
            //expec: store one offer
            Route::get('{id}', 'show');
            //expec: find all offers by car
            Route::get('by/vehicle/{vehicle_name}', 'showByVehicleName');
            //expec: find all offers by brand
            Route::get('by/brand/{id}', 'showByBrandId');
    });
});

