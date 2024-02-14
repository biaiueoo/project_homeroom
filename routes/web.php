<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
Route::resource('categories', App\Http\Controllers\JenisController::class);
Route::resource('mapel', \App\Http\Controllers\MapelController::class);
Route::resource('kompetensi', \App\Http\Controllers\KompetensiController::class);
Route::resource('guru', \App\Http\Controllers\GuruController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('kelas', \App\Http\Controllers\KelasController::class);
Route::resource('bukutamu', \App\Http\Controllers\BukutamuController::class);
Route::resource('siswa', \App\Http\Controllers\SiswaController::class);
Route::resource('agenda', \App\Http\Controllers\AgendaKegiatanController::class);
Route::resource('jadwal', \App\Http\Controllers\JadwalController::class);
Route::resource('walas', \App\Http\Controllers\WalasController::class);
Route::resource('kunjunganrumah', \App\Http\Controllers\KunjunganRumahController::class);
Route::resource('catatankasus', \App\Http\Controllers\CatatanKasusController::class);


