<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Ekstra;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function index($id)
    {
        $absen = Absen::with('kelas','siswa')
        ->where('ekstra_id',$id)
        ->get();

        $ekstra = Ekstra::find($id);  // Gantilah dengan cara Anda mengambil $ekstra

        $kelas = Kelas::whereHas('peserta', function($query) use ($ekstra) {
            $query->where('ekstra_id', $ekstra->id);
        })->get();

        $siswa = Siswa::whereHas('peserta', function($query) use ($ekstra) {
            $query->where('ekstra_id', $ekstra->id);
        })->get();

        //dd($admin);
        return  view('ekstrakurikuler.absen',compact(['absen','ekstra','kelas','siswa']));
    }

    public function simpan(Request $request, $id)
    {
        $user = Auth::user();

    // Ambil siswa yang diabsen
    $siswa = Siswa::find($request->siswa_id);

    // Ambil waktu terakhir absen
    $waktuTerakhirAbsen = $siswa->absen()->latest('waktu_absen')->value('waktu_absen');

    // Periksa jika sudah lewat 24 jam sejak waktu terakhir absen
    if ($waktuTerakhirAbsen && Carbon::now()->diffInHours($waktuTerakhirAbsen) < 24) {
        return back()->with('error', 'Anda hanya dapat melakukan absen sekali dalam 24 jam.');
    }

    // Simpan absen
    $simpan = Absen::create([
        'siswa_id' => $request->siswa_id,
        'ekstra_id' => $id,
        'kehadiran' => $request->kehadiran,
        'pelapor' => $user->name,
        'waktu_absen' => now(),
    ]);

        return back()->with('toast_success','Berhasil Absen');
    }

    public function update($id, Request $request)
    {
        $absen = Absen::find($id);
        $absen->update($request->except('token','_method'));
        return back();
    }

    public function hapus($id)
    {
        $hapus = Absen::find($id);
        $hapus->delete();
        return back();
    }

    public function hapusdat($ekstra_id)
{
    // Lakukan logika penghapusan data absen peserta di sini
    // Misalnya, menggunakan DB::table() untuk menghapus semua data absen

    DB::table('absen')->where('ekstra_id', $ekstra_id)->delete();

    return redirect()->back()->with('toast_success', 'Semua data absen peserta berhasil dihapus.');
}
}
