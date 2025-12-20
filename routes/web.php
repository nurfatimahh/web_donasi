<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\DonationController;


Route::get('/', function () {
    return view('welcome');
});

// Route untuk login - middleware guest (hanya untuk yang belum login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
// Route logout - hanya untuk yang sudah login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});


//Tes tes 
Route::get('/program', function () {
    // ngambil data program dari database
    $programs = \App\Models\Program::latest()->get();
    return view('program', compact('programs'));
});

// Dashboard - hanya untuk user yang sudah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Backend CRUD (create & read) per tabel - dilindungi auth
// Route::middleware('auth')->group(function () {
Route::middleware('auth')->name('admin.')->group(
    function () {
        // Program
        Route::resource('programs', ProgramController::class)->only([
            'index',
            'create',
            'store',
        ]);

        // Needs
        Route::resource('needs', NeedController::class)->only([
            'index',
            'create',
            'store',
        ]);

        // Donations
        Route::resource('donations', DonationController::class)->only([
            'index',
            'create',
            'store',
        ]);
    }

);