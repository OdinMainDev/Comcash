<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_Home as Home;
use App\Http\Controllers\Controller_Login as Login;
use App\Http\Controllers\Admin\Controller_Dashboard as AdminDashboard;

Route::get('/', [Home::class, "view"])->name("index");
Route::get('/auth/login', [Login::class, "view"])->name("login");
Route::post('/auth/login', [Login::class, "process"])->name("loginPost");

Route::group( ['middleware' => ['auth', 'permission:view-dashboard']], function() {
    Route::get('/panel', [AdminDashboard::class, "view"])->name("adminDashboard");
});