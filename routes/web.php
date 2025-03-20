<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('client.layouts.master');
// });

// Route::get('login',                     [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login',                    [AuthController::class, 'login']);

// Route::get('register',                  [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('register',                 [AuthController::class, 'register']);

// Route::post('logout',                   [AuthController::class, 'logout'])->name('logout');

// Route::get('password/reset',            [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
// Route::post('password/email',           [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// // Route đặt lại mật khẩu
// Route::get('password/reset/{token}',    [AuthController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset',           [AuthController::class, 'reset'])->name('password.update');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('auth/login',        [LoginController::class,    'showFormLogin'])       ->name('login');
Route::post('auth/login',       [LoginController::class,    'login']);

Route::get('auth/logout',       [LoginController::class,    'logout'])              ->name('logout');

Route::get('auth/register',     [RegisterController::class, 'registerView'])        ->name('register');
Route::post('auth/register',    [RegisterController::class, 'register']);

Route::get('/',                 [HomeController::class,     'index'])               ->name('home');
Route::get('amenity',           [AmenityController::class,  'amenity'])             ->name('amenity');
Route::get('service',           [AmenityController::class,  'service'])             ->name('service');
Route::get('room_types/{id}',   [RoomController::class,     'index'])               ->name('room_types');
Route::get('room_details/{id}', [RoomController::class,     'roomDetail'])          ->name('room_details');

Route::post('booking',          [BookingController::class,  'index'])               ->name('booking');
Route::post('order',            [BookingController::class,  'createOrder'])         ->name('order');

Route::post('apply-discount',   [BookingController::class,  'applyDiscount'])       ->name('applyDiscount');

Route::get('payment/callback', [BookingController::class, 'paymentCallback'])->name('payment.callback');

Route::post('momo-payment',     [CheckOutController::class, 'momoPayment'])         ->name('momoPayment');

Route::post('momo/ipn', [BookingController::class, 'handleIpn'])->name('momo.ipn');

Route::get('/booking/failed', [BookingController::class, 'bookingFailed'])->name('booking.failed');

Route::get('/booking/success', [BookingController::class, 'bookingSuccess'])->name('booking.success');