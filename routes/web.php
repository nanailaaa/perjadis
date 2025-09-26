<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class,'registerlihat'])->name('register.lihat');
Route::middleware(['auth'])->group( function () {

    Route::get('/user',[UserController::class,'index']);
});
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginSubmit'])->name('login.post');
Route::post('/register/submit',[AuthController::class,'registersubmit'])->name('register.submit');
Route::get('/default', [AuthController::class, 'default'])->name('default')->middleware('auth');