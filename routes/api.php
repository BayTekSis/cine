<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/use', function () {
    return \Illuminate\Support\Facades\Auth::user();
});

Route::get('test',[\App\Http\Controllers\ApiController::class,'test']);

Route::post('login', [\App\Http\Controllers\ApiController::class,'login'])->name('api.login');
Route::post('register', [\App\Http\Controllers\ApiController::class,'register'])->name('api.register');

Route::middleware('auth:api')->group(function (){


    Route::get('user',[\App\Http\Controllers\ApiController::class,'user']);
});

Route::get('cities',[\App\Http\Controllers\ApiController::class,'cities']);
Route::get('films/city={city_id}&genre={genre_id}&cinema={cinema_id}',[\App\Http\Controllers\ApiController::class,'films']);
Route::get('film-cities/{film_id}',[\App\Http\Controllers\ApiController::class,'film_cities']);

Route::post('tickets',[\App\Http\Controllers\ApiController::class,'tickets']);
Route::post('ticket-register',[\App\Http\Controllers\ApiController::class,'ticket_register'])->name('ticket.register');
