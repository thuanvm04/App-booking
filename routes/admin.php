<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        });
        Route::resource('room_types', RoomTypeController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('promotions', PromotionController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('amenities', AmenityController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('banners', BannerController::class);
    });
