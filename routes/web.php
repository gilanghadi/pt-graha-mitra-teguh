<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
  Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
  Route::post('/profile/{id}', [AuthController::class, 'profilePost'])->name('profilePost');
  Route::resource('karyawan', KaryawanController::class);
});
