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
Route::post('/process-payment', [App\Http\Controllers\Web\HomeController::class, 'processPayment'])->name('payment.process');
Route::get('/success', [App\Http\Controllers\Web\HomeController::class, 'success'])->name('success');
Route::get('/failure', [App\Http\Controllers\Web\HomeController::class, 'failure'])->name('failure');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'authUserProfile'])->name('profile')->middleware('auth');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password')->middleware('auth');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update.password')->middleware('auth');
Route::resource('countries', App\Http\Controllers\Web\CountryController::class);
Route::resource('currencies', App\Http\Controllers\Web\CurrencyController::class);
