<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Halaman Utama (API Quran/Home) - Dipindah ke sini agar tidak perlu login
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Publik Lainnya
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/program', [ProgramController::class, 'publicIndex']);
Route::get('/donasi', function () {
    return view('donasi');
});

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
    Route::get('/history', [DonationController::class, 'history'])->name('history');


    // Route untuk Notifikasi
    Route::get('/notifications/mark-all-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notifications.markAllRead');

    Route::get('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            // Redirect ke URL yang disimpan di data notifikasi, atau ke home jika tidak ada
            // Jika payload notifikasi lama tidak memiliki `url`, arahkan ke halaman history
            return redirect($notification->data['url'] ?? route('history'));
        }
        return redirect()->back();
    })->name('notifications.read');

    // Grup rute admin
    Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::patch('/donations/{donation}/verify', [DonationController::class, 'verify'])->name('donations.verify');
        Route::patch('/donations/{donation}/reject', [DonationController::class, 'reject'])->name('donations.reject');

        Route::resource('programs', ProgramController::class);
        Route::resource('needs', NeedController::class);

        // Rute PDF
        Route::get('/donations/pdf', [DonationController::class, 'view_pdf'])->name('donations.view_pdf');

        // CRUD Lengkap Donasi Admin
        Route::resource('donations', DonationController::class);


        Route::patch('/admin/donations/{donation}/reject', [App\Http\Controllers\DonationController::class, 'reject'])
            ->name('admin.donations.reject');
    });

    // Profil User
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
