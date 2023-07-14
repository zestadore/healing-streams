<?php

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

Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('home-page');
Route::get('/get-currencies/{id}', [App\Http\Controllers\Web\HomeController::class, 'getCurrencies'])->name('currencies.list');
Route::get('/get-payment-gateways/{country_id}/{currency_id}', [App\Http\Controllers\Web\HomeController::class, 'getPaymentGatways'])->name('payment-gateways.list');
Route::post('/process-payment', [App\Http\Controllers\Web\HomeController::class, 'processPayment'])->name('payment.process');
Route::get('/success', [App\Http\Controllers\Web\HomeController::class, 'success'])->name('success');
Route::get('/paypal-success', [App\Http\Controllers\Web\HomeController::class, 'PaypalPaymentSuccess'])->name('paypal.success');
Route::get('/kingspay-success', [App\Http\Controllers\Web\HomeController::class, 'KingspayPaymentSuccess'])->name('kingspay.success');
Route::get('/failure', [App\Http\Controllers\Web\HomeController::class, 'failure'])->name('failure');
Route::get('/process-payment/{id}/{choice}', [App\Http\Controllers\Web\EmailPaymentController::class, 'index'])->name('email.payment');
Route::get('/bank-transfer', [App\Http\Controllers\Web\HomeController::class, 'bankTransfer'])->name('bank-transfer');
Route::get('/crypto-transfer', [App\Http\Controllers\Web\HomeController::class, 'cryptoTransfer'])->name('crypto-transfer');
Route::get('/espee-transfer', [App\Http\Controllers\Web\HomeController::class, 'espeeTransfer'])->name('espee-transfer');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'authUserProfile'])->name('profile')->middleware('auth');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password')->middleware('auth');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update.password')->middleware('auth');
Route::get('/stripe-payments/{option}', [App\Http\Controllers\Web\PaymentController::class, 'stripePayments'])->name('payments.stripe')->middleware('auth');
Route::get('/paypal-payments/{option}', [App\Http\Controllers\Web\PaymentController::class, 'paypalPayments'])->name('payments.paypal')->middleware('auth');
Route::get('/kingspay-payments/{option}', [App\Http\Controllers\Web\PaymentController::class, 'kingspayPayments'])->name('payments.kingspay')->middleware('auth');
Route::get('/this-months-payments', [App\Http\Controllers\Web\PaymentController::class, 'thisMonthsPayments'])->name('payments.this_month')->middleware('auth');
Route::get('/monthly-automatics', [App\Http\Controllers\Web\PaymentController::class, 'monthlyAutomatic'])->name('payments.monthly_automatic')->middleware('auth');
Route::get('/pledge', [App\Http\Controllers\Web\PaymentController::class, 'pledgePayment'])->name('payments.pledge')->middleware('auth');
Route::get('/payments/{choice}', [App\Http\Controllers\Web\PaymentController::class, 'index'])->name('payments')->middleware('auth');
Route::resource('countries', App\Http\Controllers\Web\CountryController::class);
Route::resource('countries.currencies', App\Http\Controllers\Web\CountryCurrencyController::class);
Route::resource('country-currencies.payment-gateways', App\Http\Controllers\Web\CurrencyPaymentGatewayController::class);
Route::resource('currencies', App\Http\Controllers\Web\CurrencyController::class);
Route::resource('payment-gateway', App\Http\Controllers\Web\PaymentGatewayController::class);
Route::resource('regions', App\Http\Controllers\Web\RegionController::class);
