<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\CategoryController;
use Illuminate\Support\Facades\Route;




Route::view('/' , 'front.index')->name('home');



Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::middleware('role:admin')->group(function(){
        Route::get('/', function () {
            return view('backend.dashboard');
        });


        Route::get('/news/category' , [CategoryController::class, 'index'])->name('category.index');
        Route::post('/news/category' , [CategoryController::class, 'store'])->name('category.store');
        Route::get('/news/category/{id}' , [CategoryController::class, 'show'])->name('category.show');
        Route::put('/news/category/{id}' , [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/news/category/{id}' , [CategoryController::class, 'destroy'])->name('category.destroy');

    });





//    Route::middleware('role: |')->group(function(){
//
//    });


});









// auth Route
Route::view('/login' , 'auth.login')->name('login');
Route::post('/login' , [AuthController::class , 'login']);
Route::view('/register' , 'auth.register')->name('register');
Route::post('/register' , [AuthController::class , 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// auth Route end






// Reset Password

// Route #1

Route::view('/forgot-password' , 'auth.forgot-password')->name('password.request');
// Route #2
Route::post('/forgot-password' , [AuthController::class, 'sendResetLinkEmail']);
// Route #3
Route::get('/reset-password/{token}' ,  [AuthController::class, 'resetPasswordToken'])->name('password.reset');

Route::post('/reset-password' , [AuthController::class, 'passwordUpdate'])->name('password.update');;
