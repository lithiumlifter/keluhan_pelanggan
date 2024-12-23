<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluhanPelangganController;

Route::get('/', [KeluhanPelangganController::class, 'index'])->name('keluhan-dashboard');
Route::get('/keluhan', [KeluhanPelangganController::class, 'create'])->name('keluhan-form');
Route::post('/keluhan/store', [KeluhanPelangganController::class, 'store'])->name('keluhan.store');
Route::put('keluhan/{id}', [KeluhanPelangganController::class, 'update'])->name('keluhan.update');
Route::get('keluhan/{id}', [KeluhanPelangganController::class, 'show'])->name('keluhan.show');
Route::delete('keluhan/{id}', [KeluhanPelangganController::class, 'destroy'])->name('keluhan.destroy');


Auth::routes();

Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])
    ->where('any', '.*')
    ->name('home');
