<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RegisterController;

// Redirect default route to the register page
Route::get('/', function () {
    return redirect()->route('register');
});

// Routes for RegisterController
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.action');

// Routes for LoginController
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'prosLogin'])->name('login.action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Presensi routes
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::post('/presensi/check-in', [PresensiController::class, 'checkIn'])->name('presensi.checkIn');
Route::post('/presensi/check-out', [PresensiController::class, 'checkOut'])->name('presensi.checkOut');

// Absence routes
Route::get('/absence-form', [AbsenceController::class, 'index'])->name('absence.form');
Route::post('/absence', [AbsenceController::class, 'store'])->name('absence.store');

// Report routes
Route::get('/report', [ReportController::class, 'index'])->name('report.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::post('/presensi/check-in', [PresensiController::class, 'checkIn'])->name('presensi.checkIn');
    Route::post('/presensi/check-out', [PresensiController::class, 'checkOut'])->name('presensi.checkOut');
    Route::post('/absence', [AbsenceController::class, 'store'])->name('absence.store');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});
