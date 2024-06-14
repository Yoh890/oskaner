<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\EkstraController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiswaController;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PrestasiController::class,'welcome']);

Route::group(['middleware' => ['auth']], function (){
    Route::get('/dashboard', [SiswaController::class,'dashboard'])->name('dashboard');
    Route::get('/admin', function () {
        return view('admin');
    });
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka']], function (){
    Route::get('/siswa/reset', [SiswaController::class, 'reset'])->name('siswa_reset');
});

Route::group(['middleware' => ['auth','ceklevel:admin']], function (){
    Route::get('/pengguna', [PenggunaController::class,'index'])->name('pengguna');
    Route::POST('/pengguna/simpan', [PenggunaController::class,'simpan'])->name('pengguna_simpan');
    Route::get('/pengguna/hapus/{id}', [PenggunaController::class,'hapus'])->name('pengguna_hapus');
    Route::put('/pengguna/update/{id}', [PenggunaController::class,'update'])->name('pengguna_update');
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka,bk,osis']], function (){
    Route::get('/siswa', [SiswaController::class,'index'])->name('sis');
    Route::POST('/siswa/simpan', [SiswaController::class,'simpan'])->name('sis_simpan');
    Route::get('/siswa/hapus/{id}', [SiswaController::class,'hapus'])->name('sis_hapus');
    Route::put('/siswa/update/{id}', [SiswaController::class,'update'])->name('sis_update');
    Route::POST('/siswa/import', [SiswaController::class,'siswaimportexcel'])->name('sis_import');
    Route::get('/siswa/view/{id}', [SiswaController::class,'view'])->name('sis_view');
    Route::post('/siswa/naik-kelas-massal', [SiswaController::class, 'naikKelasMassal'])->name('siswa.naikKelasMassal');

    Route::get('/pelanggaran', [PelanggaranController::class,'index'])->name('pel');
    Route::get('/pelanggaran/tambah', [PelanggaranController::class,'tambah'])->name('pel_tambah');
    Route::POST('/pelanggaran/simpan', [PelanggaranController::class,'simpan'])->name('pel_simpan');
    Route::get('/pelanggaran/hapus/{id}', [PelanggaranController::class,'hapus'])->name('pel_hapus');
    Route::get('/pelanggaran/ubah/{id}', [PelanggaranController::class,'ubah'])->name('pel_ubah');
    Route::put('/pelanggaran/update/{id}', [PelanggaranController::class,'update'])->name('pel_update');

    Route::get('/kelas', [KelasController::class,'index'])->name('kel');
    Route::get('/kelas/tambah', [KelasController::class,'tambah'])->name('kel_tambah');
    Route::POST('/kelas/simpan', [KelasController::class,'simpan'])->name('kel_simpan');
    Route::get('/kelas/hapus/{id}', [KelasController::class,'hapus'])->name('kel_hapus');
    Route::get('/kelas/ubah/{id}', [KelasController::class,'ubah'])->name('kel_ubah');
    Route::put('/kelas/update/{id}', [KelasController::class,'update'])->name('kel_update');

    Route::get('/laporan', [LaporanController::class,'index'])->name('lap');
    Route::get('/laporan/tambah', [LaporanController::class,'tambah'])->name('lap_tambah');
    Route::POST('/laporan/simpan', [LaporanController::class,'simpan'])->name('lap_simpan');
    Route::get('/laporan/hapus/{id}', [LaporanController::class,'hapus'])->name('lap_hapus');
    Route::get('/laporan/ubah/{id}', [LaporanController::class,'ubah'])->name('lap_ubah');
    Route::put('/laporan/update/{id}', [LaporanController::class,'update'])->name('lap_update');
    Route::get('/laporan/hapusall', [LaporanController::class, 'hapusdat'])->name('lapdat_hapus');

    Route::get('/rekap/pelanggaran', [SiswaController::class,'rekap'])->name('rekap_pelanggaran');
    Route::get('/rekap/laporan', [LaporanController::class,'rekap'])->name('rekap_laporan');
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka,osis']], function (){
    Route::POST('/ekstra/simpan', [EkstraController::class,'simpan'])->name('ekstra_simpan');
    Route::get('/ekstra/hapus/{id}', [EkstraController::class,'hapus'])->name('ekstra_hapus');
    Route::put('/ekstra/update/{id}', [EkstraController::class,'update'])->name('ekstra_update');

    Route::get('/rekap/ekskul', [PelatihController::class,'rekap'])->name('rekap_pelatih');
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka,osis,ekskul']], function (){
    Route::get('/ekstra', [EkstraController::class,'index'])->name('ekstra');
    Route::POST('/peserta/import', [EkstraController::class,'pesertaimportexcel'])->name('peserta_import');

    Route::get('/ekskul', [EkskulController::class,'index'])->name('ekskul');
    Route::POST('/ekskul/simpan', [EkskulController::class,'simpan'])->name('ekskul_simpan');
    Route::get('/ekskul/hapus/{id}', [EkskulController::class,'hapus'])->name('ekskul_hapus');
    Route::put('/ekskul/update/{id}', [EkskulController::class,'update'])->name('ekskul_update');

    Route::get('/absen/{id}', [AbsenController::class,'index'])->name('absen');
    Route::POST('/absen/{ekstra_id}/simpan', [AbsenController::class,'simpan'])->name('absen_simpan');
    Route::get('/absen/hapus/{id}', [AbsenController::class,'hapus'])->name('absen_hapus');
    Route::put('/absen/update/{id}', [AbsenController::class,'update'])->name('absen_update');
    Route::delete('/absen/{ekstra_id}/hapus', [AbsenController::class, 'hapusdat'])->name('absendat_hapus');

    Route::get('/peserta/{id}', [PesertaController::class,'index'])->name('peserta');
    Route::POST('/peserta/{ekstra_id}/simpan', [PesertaController::class,'simpan'])->name('peserta_simpan');
    Route::POST('/peserta/{ekstra_id}/reset', [PesertaController::class,'reset'])->name('peserta_reset');
    Route::get('/peserta/hapus/{id}', [PesertaController::class,'hapus'])->name('peserta_hapus');
    Route::put('/peserta/update/{id}', [PesertaController::class,'update'])->name('peserta_update');

    Route::get('/pelatih/{id}', [PelatihController::class,'index'])->name('pelatih');
    Route::POST('/pelatih/{ekstra_id}/absen', [PelatihController::class,'absen'])->name('pelatih_absen');
    Route::get('/pelatih/hapus/{id}', [PelatihController::class,'hapus'])->name('pelatih_hapus');
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka,osis']], function (){
    Route::get('/kegiatan', [KegiatanController::class,'index'])->name('keg');
    Route::POST('/kegiatan/simpan', [KegiatanController::class,'simpan'])->name('keg_simpan');
    Route::get('/kegiatan/hapus/{id}', [KegiatanController::class,'hapus'])->name('keg_hapus');
    Route::put('/kegiatan/update/{id}', [KegiatanController::class,'update'])->name('keg_update');
});

Route::group(['middleware' => ['auth','ceklevel:admin,waka,bk']], function (){
    Route::get('/prestasi', [PrestasiController::class,'index'])->name('prestasi');
    Route::POST('/prestasi/simpan', [PrestasiController::class,'simpan'])->name('prestasi_simpan');
    Route::get('/prestasi/hapus/{id}', [PrestasiController::class,'hapus'])->name('prestasi_hapus');
    Route::put('/prestasi/update/{id}', [PrestasiController::class,'update'])->name('prestasi_update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
