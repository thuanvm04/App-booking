<?php

use App\Http\Controllers\API\PromotionController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\RoomTypeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::group([
    'middleware' => 'auth:sanctum'
],function(){
    // profile
    Route::get('profile', [UserController::class, 'profile']);
    // logout
    Route::get('logout', [UserController::class, 'logout']);
});
Route::apiResource('rooms', RoomController::class);
Route::apiResource('room_type', RoomTypeController::class);
Route::apiResource('promotions', PromotionController::class);
