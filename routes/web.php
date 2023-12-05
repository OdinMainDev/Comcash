<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Controller_Dashboard as AdminDashboard;
use App\Http\Controllers\Admin\Controller_Currency as AdminCurrency;
use App\Http\Controllers\Admin\DataTable\Controller_Currency as DTCurrency;
use App\Http\Controllers\Admin\Controller_Merchant as AdminMerchant;
use App\Http\Controllers\Admin\DataTable\Controller_Merchant as DTMerchant;
use App\Http\Controllers\Admin\Controller_Profile as AdminProfile;
use App\Http\Controllers\Admin\Controller_Role as AdminRole;
use App\Http\Controllers\Admin\DataTable\Controller_Role as DTRole;
use App\Http\Controllers\Admin\Controller_Direction as AdminDirection;
use App\Http\Controllers\Admin\DataTable\Controller_Direction as DTDirection;
use App\Http\Controllers\Admin\Controller_Api as AdminApi;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Admin\Controller_Blog as AdminBlog;
use App\Http\Controllers\Admin\DataTable\Controller_Blog as DTBlog;
use App\Http\Controllers\Admin\Controller_Feedback as AdminFeedback;
use App\Http\Controllers\Admin\DataTable\Controller_Feedback as DTFeedback;
use App\Http\Controllers\Admin\Controller_Exchange as AdminExchange;
use App\Http\Controllers\Admin\DataTable\Controller_Exchange as DTExchange;
use App\Http\Controllers\Admin\DataTable\Controller_ExchangeLog as DTExchangeLog;


use App\Http\Controllers\Controller_Home as Home;
use App\Http\Controllers\Controller_Login as Login;
use App\Http\Controllers\Controller_Register as Register;
use App\Http\Controllers\Controller_ResetPassword as ResetPassword;
use App\Http\Controllers\Controller_Profile as Profile;
use App\Http\Controllers\Controller_Exchange as Exchange;
use App\Http\Controllers\Controller_KnowledgeBase as KnowledgeBase;

Route::get('/', function () {
    $lang = Cookie::get('language');
    if(!$lang){
        $lang = "ru";
    }
    return redirect("/".$lang);
});

Route::get('/request-exportjson.json', [Home::class, "export_json"])->name("index");


/* AUTH ROUTES */
Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::get('/', [Home::class, "view"])->name("index");
    Route::get('/auth/login', [Login::class, "view"])->name("login");
    Route::post('/auth/login', [Login::class, "process"])->name("loginPost");
    Route::get('/auth/register', [Login::class, "view"])->name("register");
    Route::post('/auth/register', [Register::class, "process"])->name("registerPost");
    Route::get('/auth/reset-password', [Login::class, "view"])->name("resetPassword");
    Route::post('/auth/reset-password', [ResetPassword::class, "reset_process"])->name("resetPasswordPost");
    Route::post('/auth/reset-password/confirm', [ResetPassword::class, "confirm_process"])->name("resetPasswordConfirmPost");
    Route::get('/auth/email/confirm/{id}/{hash}', [Login::class, "view"])->name("verifyEmail"); 
});
/* AUTH ROUTES */

/* PUBLIC ROUTES */
Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::post('/exchange/redirect', [Exchange::class, "redirect"])->name("redirectToExchange");
    Route::get('/exchange/create', [Exchange::class, "view"])->name("exchgangePage");
    Route::post('/exchange/create', [Exchange::class, "create"])->name("exchgangeCreate");
    Route::get('/exchange/id/{hash}', [Exchange::class, "view_2"])->name("exchgangePage2");

    Route::get('/comcash-knowledgebase/{name}', [KnowledgeBase::class, "static_page"])->name("comcashPage");
    Route::post('/comcash-knowledgebase/support', [KnowledgeBase::class, "support"])->name("comcashSupport");
});
/* PUBLIC ROUTES */

/* PRIVATE ROUTES */
Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {

    Route::group( ['middleware' => ['auth']], function() {
        Route::get('/auth/logout', [Login::class, "logout"])->name("logout");
        
        Route::get('/profile', [Profile::class, "view"])->name("myprofile");
        Route::post('/profile/update', [Profile::class, "process_profile"])->name("myprofilePost");

        Route::get('/profile/password', [Profile::class, "view_password"])->name("myprofilePassword");
        Route::post('/profile/password/change', [Profile::class, "process_password"])->name("myprofilePasswordPost");
    });
    
});
/* PRIVATE ROUTES */

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::group( ['middleware' => ['auth', 'permission:view-dashboard']], function() {
        Route::get('/panel', [AdminDashboard::class, "view"])->name("adminDashboard");

        Route::get('/panel/profile', [AdminProfile::class, "view"])->name("adminProfile");
        Route::post('/panel/profile', [AdminProfile::class, "process"])->name("adminProfileProcess");

        Route::post('ckeditor/upload', [AdminDashboard::class, "upload"])->name('ckeditor.image-upload');

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

    Route::group( ['middleware' => ['auth', 'permission:handle-directions']], function() {
        Route::get('/panel/directions/list', [DTDirection::class, "view"])->name("adminDirectionList");
        Route::get('/panel/directions/list/data', [DTDirection::class, "process"]);

        Route::get('/panel/directions/add', [AdminDirection::class, "add"])->name("adminDirectionAdd");
        Route::post('/panel/directions/add/process', [AdminDirection::class, "add_process"])->name("adminDirectionAddProcess");
        Route::get('/panel/directions/edit/{id}', [AdminDirection::class, "edit"])->name("adminDirectionEdit");
        Route::post('/panel/directions/process', [AdminDirection::class, "edit_process"])->name("adminDirectionProcess");
    });

    Route::group( ['middleware' => ['auth', 'permission:handle-blog']], function() {
        Route::get('/panel/blog/list', [DTBlog::class, "view"])->name("adminBlogList");
        Route::get('/panel/blog/list/data', [DTBlog::class, "process"]);

        Route::get('/panel/blog/add', [AdminBlog::class, "add"])->name("adminBlogAdd");
        Route::get('/panel/blog/edit/{id}', [AdminBlog::class, "edit"])->name("adminBlogEdit");
        Route::post('/panel/blog/process', [AdminBlog::class, "process"])->name("adminBlogProcess");
    });

    Route::group( ['middleware' => ['auth', 'permission:handle-feedback']], function() {
        Route::get('/panel/feedback/list', [DTFeedback::class, "view"])->name("adminFeedbackList");
        Route::get('/panel/feedback/list/data', [DTFeedback::class, "process"]);

        Route::get('/panel/feedback/add', [AdminFeedback::class, "add"])->name("adminFeedbackAdd");
        Route::get('/panel/feedback/edit/{id}', [AdminFeedback::class, "edit"])->name("adminFeedbackEdit");
        Route::post('/panel/feedback/process', [AdminFeedback::class, "process"])->name("adminFeedbackProcess");
        Route::get('/panel/feedback/delete/{id}', [AdminFeedback::class, "delete"])->name("adminFeedbackDelete");
    });

    Route::group( ['middleware' => ['auth', 'permission:handle-exchanges']], function() {
        Route::get('/panel/exchanges/list', [DTExchange::class, "view"])->name("adminExchangeList");
        Route::get('/panel/exchanges/list/data', [DTExchange::class, "process"]);

        Route::get('/panel/exchanges/edit/{id}', [AdminExchange::class, "edit"])->name("adminExchangeEdit");
        Route::get('/panel/exchanges/logs/{id}/data', [DTExchangeLog::class, "process"])->name("adminExchangeLogs");
    });




    Route::group( ['middleware' => ['auth', 'permission:handle-directions']], function() {
        Route::get('/panel/api/get/currencies', [AdminApi::class, "currencies"]);
        Route::get('/panel/api/get/merchants', [AdminApi::class, "merchants"]);
    });
});

Route::group(config('translation.route_group_config') + ['namespace' => 'JoeDixon\\Translation\\Http\\Controllers'], function ($router) {
    $router->get(config('translation.ui_url'), 'LanguageController@index')
        ->name('languages.index');

    $router->get(config('translation.ui_url').'/create', 'LanguageController@create')
        ->name('languages.create');

    $router->post(config('translation.ui_url'), 'LanguageController@store')
        ->name('languages.store');

    $router->get(config('translation.ui_url').'/{language}/translations', 'LanguageTranslationController@index')
        ->name('languages.translations.index');

    $router->post(config('translation.ui_url').'/{language}', 'LanguageTranslationController@update')
        ->name('languages.translations.update');

    $router->get(config('translation.ui_url').'/{language}/translations/create', 'LanguageTranslationController@create')
        ->name('languages.translations.create');

    $router->post(config('translation.ui_url').'/{language}/translations', 'LanguageTranslationController@store')
        ->name('languages.translations.store');
});