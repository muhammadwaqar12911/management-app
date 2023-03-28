<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'dashboard');

Route::view('login', 'admin.login')->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [HomeController::class, 'dashboard']);

    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('runners', RunnerController::class);
    Route::resource('items', ItemController::class);
    Route::resource('orders', OrderController::class);
    Route::get('sales', [OrderController::class, 'sales']);
    Route::get('download', [OrderController::class, 'download']);
});
