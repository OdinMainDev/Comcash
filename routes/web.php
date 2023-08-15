<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_Home as Home;
use App\Http\Controllers\Controller_Login as Login;
use App\Http\Controllers\Admin\Controller_Dashboard as AdminDashboard;
use App\Http\Controllers\Admin\Controller_Currency as AdminCurrency;
use App\Http\Controllers\Admin\DataTable\Controller_Currency as DTCurrency;
use App\Http\Controllers\Admin\Controller_Merchant as AdminMerchant;
use App\Http\Controllers\Admin\DataTable\Controller_Merchant as DTMerchant;
use App\Http\Controllers\Admin\Controller_Profile as AdminProfile;
use App\Http\Controllers\Admin\Controller_Role as AdminRole;
use App\Http\Controllers\Admin\DataTable\Controller_Role as DTRole;

Route::get('/', [Home::class, "view"])->name("index");
Route::get('/auth/login', [Login::class, "view"])->name("login");
Route::post('/auth/login', [Login::class, "process"])->name("loginPost");

Route::group( ['middleware' => ['auth', 'permission:view-dashboard']], function() {
    Route::get('/panel', [AdminDashboard::class, "view"])->name("adminDashboard");

    Route::get('/panel/profile', [AdminProfile::class, "view"])->name("adminProfile");
    Route::post('/panel/profile', [AdminProfile::class, "process"])->name("adminProfileProcess");

});

Route::group( ['middleware' => ['auth', 'permission:handle-currencies']], function() {
    Route::get('/panel/currencies/list', [DTCurrency::class, "view"])->name("adminCurrencyList");
    Route::get('/panel/currencies/list/data', [DTCurrency::class, "process"]);

    Route::get('/panel/currencies/add', [AdminCurrency::class, "add"])->name("adminCurrencyAdd");
    Route::get('/panel/currencies/edit/{id}', [AdminCurrency::class, "edit"])->name("adminCurrencyEdit");
    Route::post('/panel/currencies/process', [AdminCurrency::class, "process"])->name("adminCurrencyProcess");
});

Route::group( ['middleware' => ['auth', 'permission:handle-merchants']], function() {
    Route::get('/panel/merchants/list', [DTMerchant::class, "view"])->name("adminMerchantList");
    Route::get('/panel/merchants/list/data', [DTMerchant::class, "process"]);

    Route::get('/panel/merchants/add', [AdminMerchant::class, "add"])->name("adminMerchantAdd");
    Route::get('/panel/merchants/edit/{id}', [AdminMerchant::class, "edit"])->name("adminMerchantEdit");
    Route::post('/panel/merchants/process', [AdminMerchant::class, "process"])->name("adminMerchantProcess");
});

Route::group( ['middleware' => ['auth', 'permission:handle-roles']], function() {
    Route::get('/panel/roles/list', [DTRole::class, "view"])->name("adminRoleList");
    Route::get('/panel/roles/list/data', [DTRole::class, "process"]);

    Route::get('/panel/roles/add', [AdminRole::class, "add"])->name("adminRoleAdd");
    Route::get('/panel/roles/edit/{id}', [AdminRole::class, "edit"])->name("adminRoleEdit");
    Route::post('/panel/roles/process', [AdminRole::class, "process"])->name("adminRoleProcess");
});