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
use App\Http\Controllers\DKelasController;
use App\Http\Controllers\DMapelController;
use App\Http\Controllers\GuruExportController;
use App\Http\Controllers\KakomController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanExportController;
use App\Http\Controllers\KelasExportController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\KompetensiExportController;
use App\Http\Controllers\SiswakesController;
use App\Http\Controllers\LaporankasusController;
use App\Http\Controllers\PresentaseController;
use App\Http\Controllers\PembinaanBkController;

use App\Models\Kompetensi;
use App\Http\Controllers\RencanakegiatanController;

use App\Models\KunjunganRumah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaExportController;
use App\Http\Controllers\StrukturController;
use App\Models\CatatanKasus;
use App\Models\PembinaanBK;

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

//ROLE ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/catatankasus/pdf', [CatatanKasusController::class, 'pdfDownload'])->name('ckpdf')->middleware('auth');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('kompetensi', KompetensiController::class);
    Route::get('/rencanakegiatan/pdf', [RencanakegiatanController::class, 'downloadPDF'])->name('rencanakegiatan.pdf');
    Route::resource('rencanakegiatan', RencanakegiatanController::class);
    Route::patch('/rencanakegiatan/{id}', [RencanakegiatanController::class, 'update'])->name('rencanakegiatan.update');
    // Route::post('/rencanakegiatan/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('uploadFile');
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('users', UserController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('dmapel', DMapelController::class);
    Route::get('mapel/{id}/detail', [DMapelController::class, 'detail'])->name('dmapel.detail');
    Route::resource('walas', WalasController::class);
    Route::get('/struktur/pdf', [StrukturController::class, 'downloadPDF'])->name('struktur.pdf');
    Route::resource('struktur', StrukturController::class);
    Route::get('struktur/{id}', [StrukturController::class, 'show'])->name('struktur.show');
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::get('/catatankasus/pdf/{id}', [CatatanKasusController::class, 'downloadPDF'])->name('catatankasus.pdf');
    Route::get('/catatankasus/pdfsp', [CatatanKasusController::class, 'pdfSP'])->name('catatankasus.pdf.sp');
    Route::post('/naikkan-kasus', [CatatanKasusController::class, 'naikkanKasus'])->name('naikkanKasus');
    Route::post('/tutup-kasus', [CatatanKasusController::class, 'tutupKasus'])->name('tutupKasus');

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


    Route::post('/proses-penyerahan', [DaftarrapotController::class, 'prosesPenyerahan'])->name('prosesPenyerahan');

    Route::get('/guru/pdf', [GuruController::class, 'downloadPDF'])->name('guru.pdf');
    Route::resource('guru', GuruController::class);
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::get('/kunjunganrumah/pdf/{id}', [KunjunganRumahController::class, 'downloadPDF'])->name('kunjunganrumah.pdf');
    //  Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/rencanakegiatan/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('rencana.uploadFile');
    Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('kunjungan.uploadFile');


    Route::get('/siswa/file-import', [SiswaController::class, 'importView'])->name('siswa-import-view');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa-import');
    Route::controller(SiswaExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/siswa', 'export')->name('export.siswa');
    });

    Route::get('/guru/file-import', [GuruController::class, 'importView'])->name('guru-import-view');
    Route::post('/guru/import', [GuruController::class, 'import'])->name('guru-import');
    Route::controller(GuruExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/guru', 'export')->name('export.guru');
    });

    Route::get('/kegiatan/file-import', [KegiatanController::class, 'importView'])->name('kegiatan-import-view');
    Route::post('/kegiatan/import', [KegiatanController::class, 'import'])->name('kegiatan-import');
    Route::controller(KegiatanExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/kegiatan', 'export')->name('export.kegiatan');
    });

    Route::get('/kompetensi/file-import', [KompetensiController::class, 'importView'])->name('kompetensi-import-view');
    Route::post('/kompetensi/import', [KompetensiController::class, 'import'])->name('kompetensi-import');
    Route::controller(KompetensiExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/kompetensi', 'export')->name('export.kompetensi');
    });

    Route::get('/kelas/file-import', [KelasController::class, 'importView'])->name('kelas-import-view');
    Route::post('/kelas/import', [KelasController::class, 'import'])->name('kelas-import');
    Route::controller(KelasExportController::class)->group(function () {

        Route::get('index', 'index');
        Route::get('export/kelas', 'export')->name('export.kelas');
    });

    Route::get('/laporan-kasus-bk', [CatatanKasusController::class, 'laporanKasusBK'])->name('laporan.kasus.bk');
    Route::get('/laporan-kasus-kakom', [CatatanKasusController::class, 'laporanKasusKakom'])->name('laporan.kasus.kakom');
    Route::put('/catatankasus/{id}/update-status', [CatatanKasusController::class, 'updateStatus'])->name('catatankasus.updateStatus');

    Route::resource('pembinaanbk', PembinaanBkController::class);
    Route::get('/pembinaan-bk', [PembinaanBkController::class, 'pembinaan'])->name('pembinaanbk.pembinaan');
    Route::get('/pembinaan-bk-selesai', [PembinaanBkController::class, 'kasusSelesai'])->name('pembinaanbk.selesai');
    Route::post('/mulai-pembinaan', [PembinaanBkController::class, 'mulaiPembinaan'])->name('mulaiPembinaan');
    Route::get('/pembinaan-kasus-bk', [PembinaanBkController::class, 'pembinaanKasusBK'])->name('pembinaan.kasus.bk');

    Route::resource('dkelas', DKelasController::class);
    Route::get('dkelas/{id}/detail', [DKelasController::class, 'detail'])->name('dkelas.detail');

    Route::resource('kesiswaan', KesiswaanController::class);
    Route::get('/data-siswa', [KesiswaanController::class, 'siswa'])->name('kesiswaan.siswa');
    Route::get('/data-kasus-kesiswaan', [KesiswaanController::class, 'kasus'])->name('kesiswaan.kasus');
    Route::post('/selesaikan-kasus', [PembinaanBkController::class, 'selesaikanKasus'])->name('selesaikanKasus');
    Route::get('/kasus-selesai', [KesiswaanController::class, 'kasusSelesai'])->name('kesiswaan.kasusSelesai');
    Route::get('/data-homevisit-kesiswaan', [KesiswaanController::class, 'homevisit'])->name('kesiswaan.homevisit');

    Route::resource('kakom', KakomController::class);
    Route::get('/data-seluruh-siswa', [KakomController::class, 'siswa'])->name('kakom.siswa');
    Route::get('/data-kasus-kakom', [KakomController::class, 'kasus'])->name('kakom.kasus');
    Route::get('/data-homevisit', [KakomController::class, 'homevisit'])->name('kakom.homevisit');
});

// ROLE WALI KELAS
Route::middleware(['auth', 'role:walikelas'])->group(function () {
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
    Route::resource('dashboard', DashboardController::class);
    Route::resource('presentase', PresentaseController::class);
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::get('/catatankasus/pdf', [CatatanKasusController::class, 'PDFdownload'])->name('ckpdf');
    Route::get('/struktur/pdf', [StrukturController::class, 'downloadPDF'])->name('struktur.pdf');
    Route::resource('struktur', StrukturController::class);
    Route::get('struktur/{id}', [StrukturController::class, 'show'])->name('struktur.show');
    Route::get('/rencanakegiatan/pdf', [RencanakegiatanController::class, 'downloadPDF'])->name('rencanakegiatan.pdf');
    Route::resource('rencanakegiatan', RencanakegiatanController::class);
    Route::patch('/rencanakegiatan/{id}', [RencanakegiatanController::class, 'update'])->name('rencanakegiatan.update');
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::get('/kunjunganrumah/pdf/{id}', [KunjunganRumahController::class, 'downloadPDF'])->name('kunjunganrumah.pdf');
    //  Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/rencanakegiatan/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('rencana.uploadFile');
    Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('kunjungan.uploadFile');
    Route::resource('catatankasus', CatatanKasusController::class);
    Route::get('/catatankasus/pdf', [CatatanKasusController::class, 'downloadPDF'])->name('catatankasus.pdf');
});

//ROLE KESISWAAN
Route::middleware(['auth', 'role:kesiswaan'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('siswakes', SiswakesController::class);
    Route::resource('laporankasus', LaporankasusController::class);
    Route::post('/tutup-kasus', [CatatanKasusController::class, 'tutupKasus'])->name('tutupKasus');

    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::get('/kunjunganrumah/pdf/{id}', [KunjunganRumahController::class, 'downloadPDF'])->name('kunjunganrumah.pdf');
    //  Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/rencanakegiatan/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('rencana.uploadFile');
    Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('kunjungan.uploadFile');
});

//ROLE KAKOM
Route::middleware(['auth', 'role:kakom'])->group(function () {
    Route::get('/laporan-kasus-kakom', [CatatanKasusController::class, 'laporanKasusKakom'])->name('laporan.kasus.kakom');
    Route::get('/siswa/pdf', [SiswaController::class, 'downloadPDF'])->name('siswa.pdf');
    Route::resource('siswa', SiswaController::class);
    Route::get('/siswa/file-import', [SiswaController::class, 'importView'])->name('siswa-import-view');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa-import');
    Route::controller(SiswaExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/siswa', 'export')->name('export.siswa');
    });
    Route::resource('kunjunganrumah', KunjunganRumahController::class);
    Route::get('/kunjunganrumah/pdf/{id}', [KunjunganRumahController::class, 'downloadPDF'])->name('kunjunganrumah.pdf');
    //  Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('uploadFile');
    Route::post('/rencanakegiatan/upload-file', [RencanakegiatanController::class, 'uploadFile'])->name('rencana.uploadFile');
    Route::post('/kunjunganrumah/upload-file', [KunjunganRumahController::class, 'uploadFile'])->name('kunjungan.uploadFile');
});


//ROLE BK
Route::middleware(['auth', 'role:bk'])->group(function () {
    Route::resource('laporankasus', LaporankasusController::class);
    Route::post('/mulai-pembinaan', [PembinaanBkController::class, 'mulaiPembinaan'])->name('mulaiPembinaan');
    Route::post('/selesai-pembinaan', [PembinaanBkController::class, 'selesai'])->name('selesaiPembinaan');
});

//role operator
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/siswa/pdf', [SiswaController::class, 'downloadPDF'])->name('siswa.pdf');
    Route::resource('siswa', SiswaController::class);
    Route::resource('users', UserController::class);


    Route::get('/siswa/file-import', [SiswaController::class, 'importView'])->name('siswa-import-view');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa-import');
    Route::controller(SiswaExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/siswa', 'export')->name('export.siswa');
    });
    Route::resource('kompetensi', KompetensiController::class);
    Route::resource('kelas', KelasController::class);

    Route::resource('dkelas', DKelasController::class);
    Route::get('dkelas/{id}/detail', [DKelasController::class, 'detail'])->name('dkelas.detail');

    Route::resource('mapel', MapelController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::get('/kegiatan/file-import', [KegiatanController::class, 'importView'])->name('kegiatan-import-view');
    Route::post('/kegiatan/import', [KegiatanController::class, 'import'])->name('kegiatan-import');
    Route::controller(KegiatanExportController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('export/kegiatan', 'export')->name('export.kegiatan');
    });
});
