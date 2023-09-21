<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        $users = App\Models\User::all();
        return view('dashboard')->with(compact('users'));
    }

    $receipts = (new App\Services\StripeService())->getPayments(auth()->user());

    // return with all request() data
    return view('dashboard')->with(request()->all())->with(compact('receipts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Stripe
Route::middleware('auth')->group(function () {
    Route::post('/stripe/checkout', [App\Http\Controllers\StripeController::class, 'checkout'] )->name('stripe.checkout');
    Route::get('/stripe/success', [App\Http\Controllers\StripeController::class, 'success'] )->name('stripe.success');
    Route::get('/stripe/cancel', [App\Http\Controllers\StripeController::class, 'cancel'] )->name('stripe.cancel');
});
Route::post('/stripe/webhook', [App\Http\Controllers\StripeController::class, 'handleWebhook'])->name('stripe.webhook');



require __DIR__.'/auth.php';
