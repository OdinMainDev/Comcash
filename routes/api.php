<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_Api as Api;

Route::get('/get/currencies', [Api::class, "currencies"]);
Route::get('/get/direction/settings', [Api::class, "direction_settings"]);
Route::get('/get/rates', [Api::class, "rates"]);
Route::get('/estimate', [Api::class, "estimate"]);