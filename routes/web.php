<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;




Route::view('/' , 'front.index')->name('home');


Route::get('/dashboard', function () {
    return view('backend.dashboard');
});







// auth Route
Route::view('/login' , 'auth.login')->name('login');
Route::post('/login' , [AuthController::class , 'login']);
Route::view('/register' , 'auth.register')->name('register');
Route::post('/register' , [AuthController::class , 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// auth Route end







