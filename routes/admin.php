<?php

use Illuminate\Support\Facades\Route;
// web.php
use App\Http\Controllers\ProPaymentController;
Route::post('/profile/update', [ProPaymentController::class, 'update'])->name('profile.update');

Route::get('/pro-check/{plan}', [ProPaymentController::class, 'check'])->name('pro-check');
Route::get('/paid-users', [ProPaymentController::class, 'paidusers'])->name('paid-users');

use App\Http\Controllers\SetPasswordController;
Route::get('reset', [SetPasswordController::class, 'requestForm'])->name('reset');
Route::post('password/request', [SetPasswordController::class, 'sendLink'])->name('password.email');
Route::get('password/set/{token}', [SetPasswordController::class, 'showForm'])->name('password.set.form');
Route::post('password/set', [SetPasswordController::class, 'setPassword'])->name('password.set');


