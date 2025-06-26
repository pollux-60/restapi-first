<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

// Halaman dashboard (butuh autentikasi)
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Halaman logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Group route yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa', function () {
        return view('mahasiswa');
    })->name('mahasiswa');
});