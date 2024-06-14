<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prestasi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $prestasiQuery = Prestasi::with('kelas', 'siswa');

        $kelasIdFilter = $request->input('kelas');
        if ($kelasIdFilter) {
            $prestasiQuery->where('kelas_id', $kelasIdFilter);
        }

        $prestasi = $prestasiQuery->latest()->get();
        $kel = Kelas::all();
        $sis = Siswa::all();
        $todayDate = Carbon::now()->format('Y-m-d');

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('prestasi',compact(['prestasi','kel','sis']));
    }

    public function simpan(Request $request)
    {
        $user = Auth::user();
        $simpan = Prestasi::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'dokumentasi' => $request->dokumentasi,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal
        ]);
        return  redirect()->route('prestasi')->with('toast_success', 'Berhasil Menambahkan Prestasi');
    }

    public function update($id, Request $request)
    {
        $prestasi = Prestasi::find($id);
        $prestasi->update($request->except('token','_method'));
        return  back()->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Prestasi::find($id);
        $hapus->delete();
        return  back()->with('toast_success','Berhasil');
    }

    public function welcome()
    {
        $prestasi = Prestasi::with('siswa')->get();
        return view('welcome', compact('prestasi'));
    }
}
