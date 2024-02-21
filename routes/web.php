<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\BukutamuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AgendaKegiatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\WalasController;
use App\Http\Controllers\KunjunganRumahController;
use App\Http\Controllers\CatatanKasusController;
use App\Http\Controllers\JadwalpiketController;
use App\Http\Controllers\DaftarrapotController;
use App\Http\Controllers\SiswakesController;
use App\Http\Controllers\LaporankasusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('kompetensi', KompetensiController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('users', UserController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('bukutamu', BukutamuController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('agenda', AgendaKegiatanController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('walas', WalasController::class);
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::resource('jadwalpiket', JadwalpiketController::class);
    Route::resource('daftarrapot', DaftarrapotController::class);
    Route::resource('siswakes', SiswakesController::class);
    Route::resource('laporankasus', LaporankasusController::class);
});
