<?php

use Illuminate\Support\Facades\Route;
// web.php
use App\Http\Controllers\ProPaymentController;
 Route::post('/profile/update', [ProPaymentController::class, 'update'])->name('profile.update');
 Route::get('/user-plan', [ProPaymentController::class, 'userplan'])->name('user-plan');

// Route::get('/pro-check/{plan}', [ProPaymentController::class, 'check'])->name('pro-check');
Route::get('/paid-users', [ProPaymentController::class, 'paidusers'])->name('paid-users');
Route::get('/email-configruation', [ProPaymentController::class, 'email_configruation'])->name('email-configruation');
 Route::post('/email-validate', [ProPaymentController::class, 'email_validation'])->name('email-validate');
 Route::get('/email-users', [ProPaymentController::class, 'show_email_configurations'])->name('email-users');
  Route::get('/all-configuration', [ProPaymentController::class, 'all_configurations'])->name('all-configuration');

Route::post('/subscribe', [ProPaymentController::class, 'subscriber_stor'])->name('subscribe');
Route::post('/home/subscribe', [ProPaymentController::class, 'subscriber_home'])->name('subscribe-home');

Route::get('/subscribers/email', [ProPaymentController::class, 'showSubscribers'])->name('subscriber-all');








 Route::get('/profile', [ProPaymentController::class, 'profile_edite'])->name('profile');
    Route::post('/profile/update', [ProPaymentController::class, 'profile_update'])->name('profile.update');

use App\Http\Controllers\SetPasswordController;
Route::get('reset', [SetPasswordController::class, 'requestForm'])->name('reset');
Route::post('password/request', [SetPasswordController::class, 'sendLink'])->name('password.email');
Route::get('password/set/{token}', [SetPasswordController::class, 'showForm'])->name('password.set.form');
Route::post('password/set', [SetPasswordController::class, 'setPassword'])->name('password.set');

use App\Http\Controllers\EmailConfigurationController;
Route::post('/contact', [EmailConfigurationController::class, 'contact'])->name('contact.store');
Route::get('/contacts', [EmailConfigurationController::class, 'showContacts'])->name('dashboard-contacts');

Route::middleware(['auth'])->group(function () {
    Route::get('all-configuration', [EmailConfigurationController::class, 'index'])->name('email.all');
    Route::put('email-update/{id}', [EmailConfigurationController::class, 'update'])->name('email.update');
    Route::delete('email-delete/{id}', [EmailConfigurationController::class, 'destroy'])->name('email.destroy');
});
