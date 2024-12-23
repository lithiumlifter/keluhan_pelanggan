<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluhanStatusController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('keluhan/status/{id}', [KeluhanStatusController::class, 'updateStatus']);
Route::delete('keluhan/status/{id}', [KeluhanStatusController::class, 'deleteStatus']);
