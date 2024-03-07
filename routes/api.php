<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\CKaryawan;
use App\Http\Controllers\PresensiController;
use App\Models\karyawan;

Route::post('auth/register', [Authcontroller::class, 'register'])->name('register');
Route::post('auth/login', [Authcontroller::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::resource('karyawan', CKaryawan::class);
    Route::resource('presensi', PresensiController::class);
    Route::get('auth/me', [Authcontroller::class, 'me'])->name('me');
    Route::post('auth/logout', [Authcontroller::class, 'logout'])->name('logout');
});
Route::post('/karyawan', [CKaryawan::class, 'store']);





