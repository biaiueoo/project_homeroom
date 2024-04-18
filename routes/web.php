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
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SiswakesController;
use App\Http\Controllers\LaporankasusController;
use App\Http\Controllers\PresentaseController;

use App\Models\Kompetensi;
use App\Http\Controllers\RencanakegiatanController;

use App\Models\KunjunganRumah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaExportController;

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

// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('kompetensi', KompetensiController::class);
    Route::get('/rencanakegiatan/pdf', [RencanakegiatanController::class, 'downloadPDF'])->name('rencanakegiatan.pdf');
    Route::resource('rencanakegiatan', RencanakegiatanController::class);
    Route::patch('/rencanakegiatan/{id}', [RencanakegiatanController::class, 'update'])->name('rencanakegiatan.update');
    Route::post('/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('uploadFile');
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('users', UserController::class); 
    Route::resource('kelas', KelasController::class);
    Route::resource('walas', WalasController::class);
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::resource('siswakes', SiswakesController::class);
    Route::resource('presentase', PresentaseController::class);
    Route::resource('laporankasus', LaporankasusController::class);
    Route::get('/jadwalpiket/pdf', [JadwalpiketController::class, 'downloadPDF'])->name('jadwalpiket.pdf');
    Route::resource('jadwalpiket', JadwalpiketController::class);
    Route::get('/jadwal/pdf', [JadwalController::class, 'downloadPDF'])->name('jadwal.pdf');
    Route::resource('jadwal', JadwalController::class);
    Route::get('/bukutamu/pdf', [BukutamuController::class, 'downloadPDF'])->name('bukutamu.pdf');
    Route::resource('bukutamu', BukutamuController::class);
    Route::get('/siswa/pdf', [SiswaController::class, 'downloadPDF'])->name('siswa.pdf');
    Route::resource('siswa', SiswaController::class);
    Route::get('/agenda/pdf', [AgendaKegiatanController::class, 'downloadPDF'])->name('agenda.pdf');
    Route::resource('agenda', AgendaKegiatanController::class);
    Route::get('/daftarrapot/pdf', [DaftarrapotController::class, 'downloadPDF'])->name('daftarrapot.pdf');
    Route::resource('daftarrapot', DaftarrapotController::class);
    Route::get('/guru/pdf', [GuruController::class, 'downloadPDF'])->name('guru.pdf');
    Route::resource('guru', GuruController::class);

    
    Route::get('/siswa/file-import',[SiswaController::class,'importView'])->name('siswa-import-view');
    Route::post('/siswa/import',[SiswaController::class,'import'])->name('siswa-import');
    
    Route::get('/kompetensi/file-import',[KompetensiController::class,'importView'])->name('kompetensi-import-view');
    Route::post('/kompetensi/import',[KompetensiController::class,'import'])->name('kompetensi-import');

    Route::controller(SiswaExportController::class)->group(function(){
        Route::get('index', 'index');    
        Route::get('export/siswa', 'export')->name('export.excel');
    });

});

Route::middleware(['auth', 'role:walikelas'])->group(function () {
    Route::get('/jadwalpiket/pdf', [JadwalpiketController::class, 'downloadPDF'])->name('jadwalpiket.pdf');
    Route::resource('jadwalpiket', JadwalpiketController::class);
    Route::get('/rencanakegiatan/pdf', [RencanakegiatanController::class, 'downloadPDF'])->name('rencanakegiatan.pdf');
    Route::resource('rencanakegiatan', RencanakegiatanController::class);
    Route::patch('/rencanakegiatan/{id}', [RencanakegiatanController::class, 'update'])->name('rencanakegiatan.update');
    Route::post('/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('uploadFile');
    Route::resource('kegiatan', KegiatanController::class);
    Route::get('/jadwal/pdf', [JadwalController::class, 'downloadPDF'])->name('jadwal.pdf');
    Route::resource('jadwal', JadwalController::class);
    Route::get('/bukutamu/pdf', [BukutamuController::class, 'downloadPDF'])->name('bukutamu.pdf');
    Route::resource('bukutamu', BukutamuController::class);
    Route::get('/siswa/pdf', [SiswaController::class, 'downloadPDF'])->name('siswa.pdf');
    Route::resource('siswa', SiswaController::class);
    Route::get('/agenda/pdf', [AgendaKegiatanController::class, 'downloadPDF'])->name('agenda.pdf');
    Route::resource('agenda', AgendaKegiatanController::class);
    Route::get('/daftarrapot/pdf', [DaftarrapotController::class, 'downloadPDF'])->name('daftarrapot.pdf');
    Route::resource('daftarrapot', DaftarrapotController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::resource('presentase', PresentaseController::class);
});

Route::middleware(['auth', 'role:kesiswaan'])->group(function () {
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::resource('siswakes', SiswakesController::class);
    Route::resource('laporankasus', LaporankasusController::class);
});

Route::middleware(['auth', 'role:kakom'])->group(function () {
    Route::resource('laporankasus', LaporankasusController::class);
});

Route::middleware(['auth', 'role:bk'])->group(function () {
    Route::resource('laporankasus', LaporankasusController::class);
});
