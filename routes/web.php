<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;




Route::view('/' , 'front.index')->name('home');


Route::get('/dashboard', function () {
    return view('backend.dashboard');
});







// auth Route

Route::get('/login', function () {
    return view('auth.login');
});

Route::view('/register' , 'auth.register')->name('register');
Route::post('/register' , [AuthController::class , 'register']);

// auth Route end







