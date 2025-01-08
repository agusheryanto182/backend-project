<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::post('/login', [AuthController::class, 'login']);
