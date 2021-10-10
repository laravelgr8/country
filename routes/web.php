<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[CountryController::class,'index'])->name('home');
Route::post('/getState',[CountryController::class,'getstate']);
Route::post('/getCity',[CountryController::class,'getcity']);

Route::post('/insert',[CountryController::class,'insert']);
Route::get('/show',[CountryController::class,'show']);
Route::get('/edit/{id}',[CountryController::class,'edit']);

// Route::post('/editState',[CountryController::class,'editstate']);