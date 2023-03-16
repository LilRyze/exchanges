<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FeeController;

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

Route::post('create-exchange', [ExchangeController::class, 'createExchange']);
Route::post('apply-exchange', [ExchangeController::class, 'applyExchange']);
Route::get('get-exchanges', [ExchangeController::class, 'getExchanges']);
Route::get('get-fees', [FeeController::class, 'getFees']);
