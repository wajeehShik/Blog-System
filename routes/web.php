<?php

use App\Http\Controllers\Front\ContactusController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\IndexController;
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

Route::get('/', [IndexController::class,'index'])->name('home');


Route::get('/faqs',[FaqController::class,'index'])->name('faqs');
Route::get('/contact-us',[ContactusController::class,'index'])->name('contactus');
Route::post('/contact-us',[ContactusController::class,'store'])->name('contactus');
require __DIR__ . '/auth.php';
