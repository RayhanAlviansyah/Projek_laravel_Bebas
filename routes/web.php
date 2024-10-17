<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interfaceContoller;
use App\Http\Controllers\AkunController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [interfaceContoller::class, 'index'])->name('home');

Route::prefix('/interface')->name('interface.')->group(function() {
    Route::get('data', [interfaceContoller::class, 'index'])->name('data');
    Route::get('create', [interfaceContoller::class, 'create'])->name('create');
    Route::post('create/proses', [interfaceContoller::class, 'store'])->name('create.proses');
    Route::get('data', [interfaceContoller::class, 'index'])->name('data');
    Route::get('ubah/{id}', [interfaceContoller::class, 'edit'])->name('ubah');
    Route::patch('ubah/{id}/proses', [interfaceContoller::class, 'update'])->name('ubah.proses');
    Route::delete('hapus/{id}', [interfaceContoller::class, 'destroy'])->name('hapus');
});

Route::prefix('/kelola-akun')->name('kelola_akun.')->group(function(){
    Route::get('/data', [AkunController::class, 'index'])->name('data');
    Route::get('/tambah', [AkunController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [AkunController::class, 'store'])->name('tambah.proses');
    Route::get('ubah/{id}', [AkunController::class, 'edit'])->name('ubah');
    Route::patch('ubah/{id}/proses', [AkunController::class, 'update'])->name('ubah.proses');
    Route::delete('hapus/{id}', [AkunController::class, 'destroy'])->name('hapus');
    Route::patch('ubah/stock/{id}', [AkunController::class, 'updatePassword'])->name('ubah.password');
});
