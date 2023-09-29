<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupervisorsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin/', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboradController::class, 'index'])->name('dashboard');


    //بيانات الشخصية
    Route::group([
        'prefix' => '/profile',
    ], function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/', [ProfileController::class, 'editprofile'])->name('profile.edit');
    });
    //roles
    Route::group(['prefix' => '/roles/', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/show/{id}', [RoleController::class, 'show'])->name('show');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('/update', [RoleController::class, 'update'])->name('update');
        Route::post('/delete', [RoleController::class, 'destroy'])->name('delete');
    });
    //SuperViesor
    Route::group([
        'prefix' => '/supervisors',
        'as' => 'supervisors.'
    ],  function () {
        Route::get('/', [SupervisorsController::class, 'index'])->name('index');
        Route::post('/store', [SupervisorsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SupervisorsController::class, 'edit'])->name('edit');
        Route::post('/update', [SupervisorsController::class, 'update'])->name('update');
        Route::post('/delete', [SupervisorsController::class, 'destroy'])->name('delete');
    });
    ///users
    Route::group([
        'prefix' => '/users',
        'as' => 'users.'
    ],  function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::post("edit/{id}", [UsersController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UsersController::class, 'update'])->name('update');
        Route::post('/delete', [UsersController::class, 'destroy'])->name('delete');
    });
    //pages
    Route::group([
        'prefix' => '/pages',
        'as' => 'pages.'
    ],  function () {
        Route::get('/', [PagesController::class, 'index'])->name('index');
        Route::post('/store', [PagesController::class, 'store'])->name('store');
        Route::post('/edit/{id}', [PagesController::class, 'edit'])->name('edit');
        Route::get('/show/{id}', [PagesController::class, 'show'])->name('showDate');
        Route::post('/update', [PagesController::class, 'update'])->name('update');
        Route::post('/delete', [PagesController::class, 'destroy'])->name('delete');
    });
    //category
    Route::group([
        'prefix' => '/categories',
        'as' => 'categories.'
    ],  function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::post('/store', [CategoriesController::class, 'store'])->name('store');
        Route::post('edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::post('/update', [CategoriesController::class, 'update'])->name('update');
        Route::post('/delete', [CategoriesController::class, 'delete'])->name('delete');
    });
    //tags
    Route::group([
        'prefix' => '/tags',
        'as' => 'tags.'
    ],  function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::post('/store', [TagController::class, 'store'])->name('store');
        Route::post('edit/{id}', [TagController::class, 'edit'])->name('edit');
        Route::post('/update', [TagController::class, 'update'])->name('update');
        Route::post('/delete', [TagController::class, 'destroy'])->name('delete');
    });
    //faqs
    Route::group([
        'prefix' => '/faqs',
        'as' => 'faqs.'
    ], function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::post('/edit/{id}', [FaqController::class, 'edit'])->name('edit');
        Route::post('/update', [FaqController::class, 'update'])->name('update');
        Route::post('/delete', [FaqController::class, 'destroy'])->name('delete');
    });
    //contactus 
    Route::group([
        'prefix' => '/contactus',
        'as' => 'contactus.'
    ],  function () {
        Route::get('/', [ContactusController::class, 'index'])->name('index');
        Route::post('/search', [ContactusController::class, 'ajaxSearch'])->name("ajaxSearch");

        Route::post('/show/{id}', [ContactusController::class, 'show'])->name('show');
        Route::post('/delete', [ContactusController::class, 'destroy'])->name('delete');
    });
});
