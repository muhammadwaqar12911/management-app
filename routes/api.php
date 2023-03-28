<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\RunnerController;
use App\Http\Controllers\API\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'login']);
Route::apiResource('orders', OrderController::class, array("as" => "api"));
Route::get('customers/{search?}', [CustomerController::class, 'index']);
Route::get('runners/{search?}', [RunnerController::class, 'index']);
Route::get('items/{search?}', [ItemController::class, 'index']);
