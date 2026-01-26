<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected route

        Route::get('dashboard', function () {
    return view('dashboard');
    });


 
    Route::get('trucker', function () {
    return view('emails.trucker');
});

Route::get('/', function () { return view('welcome'); });

Route::post('/paypal/create-order', [PayPalController::class, 'createOrder']);
Route::post('/paypal/capture-order/{orderId}', [PayPalController::class, 'captureOrder']);
Route::resource('subject',SubjectController::class)->except(['show']);
     Route::get('/users', [UserController::class, 'index'])->name('index');
    // Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assignRole');




     Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('index');
    Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assignRole');

});
use App\Http\Controllers\FmcsaController;
// Search Form View
Route::get('extract-data', [FmcsaController::class, 'index'])->name('extract-data');
Route::post('/fetch', [FmcsaController::class, 'fetch'])->name('fmcsa.fetch');
Route::post('/export', [FmcsaController::class, 'export'])->name('fmcsa.export');


use App\Http\Controllers\EmailSenderController;

Route::get('/email-upload', [EmailSenderController::class, 'index'])->name('email-upload');
Route::post('/send-emails', [EmailSenderController::class, 'sendEmails'])->name('send.emails');
      Route::get('', function () {
    return view('home');
});
Route::post('/emails/export', [FmcsaController::class, 'exportEmailsExcel'])->name('emails.export');




require __DIR__.'/admin.php';
