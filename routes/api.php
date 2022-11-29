<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

//    Route::get('/notifications', [NotificationController::class, 'index']);
//    Route::post('/notifications', [NotificationController::class, 'store']);
//    Route::get('/notifications/{id}', [NotificationController::class, 'show']);
//    Route::delete('/notifications/{notification}', [NotificationController::class, 'delete']);

    Route::resource('notifications', NotificationController::class)->only([
        'index', 'show', 'store', 'destroy'
    ]);
});
