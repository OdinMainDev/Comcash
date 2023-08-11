<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_Home as Home;
use App\Http\Controllers\Controller_Login as Login;
use App\Http\Controllers\Admin\Controller_Dashboard as AdminDashboard;
use App\Http\Controllers\Admin\Controller_Currency as AdminCurrency;
use App\Http\Controllers\Admin\DataTable\Controller_Currency as DTCurrency;

Route::get('/', [Home::class, "view"])->name("index");
Route::get('/auth/login', [Login::class, "view"])->name("login");
Route::post('/auth/login', [Login::class, "process"])->name("loginPost");

Route::group( ['middleware' => ['auth', 'permission:view-dashboard']], function() {
    Route::get('/panel', [AdminDashboard::class, "view"])->name("adminDashboard");
});

Route::group( ['middleware' => ['auth', 'permission:handle-currencies']], function() {
    Route::get('/panel/currencies/list', [DTCurrency::class, "view"])->name("adminCurrencyList");
    Route::get('/panel/currencies/list/data', [DTCurrency::class, "process"]);

    Route::get('/panel/currencies/add', [AdminCurrency::class, "add"])->name("adminCurrencyAdd");
    Route::get('/panel/currencies/edit/{id}', [AdminCurrency::class, "edit"])->name("adminCurrencyEdit");
    Route::post('/panel/currencies/process', [AdminCurrency::class, "process"])->name("adminCurrencyProcess");
});