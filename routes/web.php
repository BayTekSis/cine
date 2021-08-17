<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/login',[\App\Http\Controllers\MainController::class,'login'])->name('login');
Route::get('/register',[\App\Http\Controllers\MainController::class,'register']);
Route::get('/filmler',[\App\Http\Controllers\MainController::class,'films']);
Route::get('/',[\App\Http\Controllers\MainController::class,'index']);
Route::get('/{slug}',[\App\Http\Controllers\MainController::class,'detail']);
Route::get('/{slug}/city={city}',[\App\Http\Controllers\MainController::class,'detail_city']);
Route::get('/{slug}/city={city}/cinema={cinema}',[\App\Http\Controllers\MainController::class,'detail_cinema']);

