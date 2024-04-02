<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_Api as Api;

Route::get('/get/exchange/status/{hash}', [Api::class, "exchange_status"]);
Route::get('/get/currencies', [Api::class, "currencies"]);
Route::get('/get/direction/settings', [Api::class, "direction_settings"]);
Route::get('/get/directions', [Api::class, "directions"]);
Route::get('/get/rates', [Api::class, "rates"]);
Route::get('/estimate', [Api::class, "estimate"]);
Route::get('/get/directions/currencies/from', [Api::class, "direction_currencies_from"]);
// Route::get('/get/directions/currencies/to', [Api::class, "direction_currencies_to"]);