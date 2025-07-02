<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransOrderController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [LoginController::class, 'login']);
Route::get("login", [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('actionLogin',  [LoginController::class, 'actionLogin'])->name('actionLogin');

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('user', UserController::class);
    Route::resource('trans', TransOrderController::class);
    Route::get('print_struk/{id}', [App\Http\Controllers\TransOrderController::class, 'printStruk'])->name('print_struk');


    // Route::get('insert/service', [DashboardController::class, 'showInsService']);
});








Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');

// Get Table Counts
Route::get('data/hitungan', [BelajarController::class, 'viewHitungan'])->name('data.hitungan');
Route::get('edit/data-hitung/{id}', [BelajarController::class, 'editDataHitung'])->name('edit.data-hitung');
Route::post('tambah-action', [BelajarController::class, 'tambahAction'])->name('tambah-action');
// get:hanya bisa melihat dan membaca data
// post : tambah dan ubah data (form)
// put : ubah data(form)
//delete : hapus data(form)

//Put Table counts
Route::put('users/{id}', [BelajarController::class, 'updateTambahan'])->name('update.tambahan');

Route::delete('softDelete/data-hitung/{id}', [BelajarController::class, 'softDeleteTambahan'])->name('softDelete.data-hitung');
