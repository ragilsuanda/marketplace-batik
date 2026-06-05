<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanicButtonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('frontend.home.index');
});

Route::resource('/home', HomeController::class);

// Autentikasi
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute khusus USER yang sudah login
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create'); // Form laporan
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store'); // Simpan laporan
});

// Rute khusus ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/user', AdminUserController::class);
    Route::resource('/dashboard', AdminDashboardController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}/update-status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
});

// Artikel
Route::get('/apa', [ArtikelController::class, 'Apa'])->name('frontend.artikel.apa');
Route::get('/dampak', [ArtikelController::class, 'Dampak'])->name('frontend.artikel.dampak');
Route::get('/cara', [ArtikelController::class, 'Cara'])->name('frontend.artikel.cara');
Route::resource('/panicbutton', PanicButtonController::class);


Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/process', [QuizController::class, 'process'])->name('quiz.process');
