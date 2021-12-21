<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user/login', [UserController::class, 'login']);
Route::post('user/register', [UserController::class, 'register']);
Route::get('user/verify/{user}', [UserController::class, 'verify']);

Route::prefix('menu')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('menu1', MenuController::class);
    Route::apiResource('order1', OrderController::class);
    Route::apiResource('order-detail1', DetailOrderController::class);
    Route::get('users1/{user}', [UserController::class, 'getUser']);
    Route::put('users1/{user}', [UserController::class, 'updateUser']);
    Route::post('users1/{user}', [UserController::class, 'uploadImage']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
});