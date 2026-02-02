<?php

use Illuminate\Support\Facades\Route;
// web.php
use App\Http\Controllers\ProPaymentController;

Route::get('/pro-check', [ProPaymentController::class, 'check'])->name('pro-check');

