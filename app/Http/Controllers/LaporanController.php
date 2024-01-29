<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Laporan;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporanQuery = Laporan::with('kelas', 'pelanggaran', 'siswa');

        $laporan = $laporanQuery->latest()->get();
        $kel = Kelas::all();
        $pel = Pelanggaran::all();
        $sis = Siswa::all();
        $todayDate = Carbon::now()->format('Y-m-d');

        //dd($admin);
        return  view('laporan.index',compact(['laporan','kel','pel','sis']));
    }

    public function tambah()
    {
        $kel = Kelas::all();
        $pel = Pelanggaran::all();
        $sis = Siswa::all();

        return  view('laporan.tambah', compact(['kel','pel','sis']));
    }

    public function simpan(Request $request)
    {
        $user = Auth::user();
        $simpan = Laporan::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'pelanggaran_id' => $request->pelanggaran_id,
            'pelapor' => $user->name,
            'point' => $request->point
        ]);
        return  redirect()->route('lap_tambah')->with('toast_success', 'Berhasil Menambahkan Laporan');
    }

    public function ubah($id)
    {
        $laporan = Laporan::find($id);
        return  view('laporan.edit',compact(['laporan']));
    }

    public function update($id, Request $request)
    {
        $laporan = Laporan::find($id);
        $laporan->update($request->except('token','_method'));
        return  redirect('laporan');
    }

    public function hapus($id)
    {
        $hapus = Laporan::find($id);
        $hapus->delete();
        return  redirect('laporan');
    }

    public function hapusdat()
{
    // Lakukan logika penghapusan data absen peserta di sini
    // Misalnya, menggunakan DB::table() untuk menghapus semua data absen

    DB::table('laporan')->delete();

    return redirect()->back()->with('toast_success', 'Semua data absen peserta berhasil dihapus.');
}

public function rekap(Request $request)
    {
        $laporanQuery = Laporan::with('kelas', 'pelanggaran', 'siswa');

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $laporanQuery->whereBetween('created_at', [$mulai, $akhir]);
        }

        $kelasIdFilter = $request->input('kelas');
        if ($kelasIdFilter) {
            $laporanQuery->where('kelas_id', $kelasIdFilter);
        }
        $pelIdFilter = $request->input('pelanggaran');
        if ($pelIdFilter) {
            $laporanQuery->where('pelanggaran_id', $pelIdFilter);
        }

        $laporan = $laporanQuery->latest()->get();
        $kel = Kelas::all();
        $pel = Pelanggaran::all();
        $sis = Siswa::all();
        return  view('rekap.laporan', compact(['laporan','kel','pel','sis']));
    }
}
