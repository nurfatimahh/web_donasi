<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Admin\ProfileController;


Route::get('/', function () {
    $programs = \App\Models\Program::latest()->get();
    // Ambil data kebutuhan untuk isi dropdown di modal donasi
    $needs = \App\Models\Need::all();

    return view('welcome', compact('needs', 'programs'));

});

//Public Routes (Bisa diakses tanpa login)


// Halaman Utama (API Quran/Home) - Dipindah ke sini agar tidak perlu login
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Publik Lainnya
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/program', function () {
    // ngambil data program dari database
    $programs = \App\Models\Program::latest()->get();
    return view('program', compact('programs'));
});

Route::get('/donasi', [DonationController::class, 'create'])->name('donasi.create');

// Auth Routes (Guest Middleware)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'register']);
});

// Google Auth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);


//Protected Routes (Hanya untuk user yang sudah login)

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/donations/store', [DonationController::class, 'store'])->name('donations.store');

    // Grup rute admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::patch('/donations/{donation}/verify', [DonationController::class, 'verify'])->name('donations.verify');
        Route::patch('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

        Route::resource('programs', ProgramController::class);
        Route::resource('needs', NeedController::class);

        // Rute PDF
        Route::get('/donations/pdf', [DonationController::class, 'view_pdf'])->name('donations.view_pdf');

});


//halaman profile 
Route::get('/admin/profile', function () {
    return view('admin.profile');
});

//pdf reporting
Route::get('/admin/donations', [DonationController::class, 'index']);
Route::get('/admin/donations/pdf', [DonationController::class, 'view_pdf'])->name('donations.view_pdf');

//Detail Program 
Route::get('/program', [ProgramController::class, 'publicIndex']);

// Show detail program
Route::get('/admin/programs/{program}', [ProgramController::class, 'show'])->name('admin.programs.show');
