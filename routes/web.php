<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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
})->name('home');

Route::get('auth/login', [LoginController::class, 'index'])
    ->middleware(['guest'])
    ->name('auth.login');
Route::post('auth/login', [LoginController::class, 'store'])->middleware(['guest']);
Route::get('auth/session/{user:email}', [LoginController::class, 'session'])
    ->middleware(['guest', 'signed'])
    ->name('auth.session');
Route::get('auth/logout', LogoutController::class)->name('auth.logout');
Route::get('auth/register', [RegisterController::class, 'index'])
    ->middleware(['guest'])
    ->name('auth.register');
Route::post('auth/register', [RegisterController::class, 'store'])->middleware(['guest']);
