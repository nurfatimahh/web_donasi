<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

// Route untuk login - middleware guest (hanya untuk yang belum login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
// Route logout - hanya untuk yang sudah login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', function () {
    return view('login');
});

// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/program', function () {
    return view('program');
});

Route::get('/admin/dashboard', function () { 
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/program', function () { 
    return view('admin.program.index');
});

Route::get('/admin/program/create', function () { 
    return view('admin.program.create');
});