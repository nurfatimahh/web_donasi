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


Route::get('/program', function () {
    return view('program');
});

Route::get('/program', function () {
    // ngambil data program dari database
    $programs = \App\Models\Program::latest()->get();
    return view('program', compact('programs'));
});

Route::get('/donasi', function () {
    return view('donasi');
});


// Dashboard & backend CRUD - hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Dashboard utama (bisa diarahkan ke admin layout)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Grup route admin dengan prefix URL /admin dan prefix nama admin.
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Program (CRUD create + read)
        Route::resource('programs', ProgramController::class)->only([
            'index',
            'create',
            'store',
        ]);

        // (Nanti bisa ditambahkan resources lain seperti needs & donations versi admin)
    });

    // Backend CRUD umum (tanpa prefix admin) - opsional jika masih dipakai
    Route::resource('needs', NeedController::class)->only([
        'index',
        'create',
        'store',
    ]);

    Route::resource('donations', DonationController::class)->only([
        'index',
        'create',
        'store',
    ]);
});
