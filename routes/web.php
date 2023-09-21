<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome
Route::get('/', function () { return view('welcome'); });


// Auth
require __DIR__ . '/auth.php';


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('admin')->group(function () {
    Route::get('/profile/{user_id}/last-payment', [AdminController::class, 'checkLastPayment'])->name('admin.checkLastPayment');
});


// Stripe
Route::middleware('auth')->group(function () {
    Route::post('/stripe/checkout', [App\Http\Controllers\StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success', [App\Http\Controllers\StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [App\Http\Controllers\StripeController::class, 'cancel'])->name('stripe.cancel');
});
Route::post('/stripe/webhook', [App\Http\Controllers\StripeController::class, 'handleWebhook'])->name('stripe.webhook');
