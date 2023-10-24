<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/balance', [UserController::class, 'balance'])->name('balance');
    Route::get('/operation', [OperationController::class, 'index'])->name('operations');
});
