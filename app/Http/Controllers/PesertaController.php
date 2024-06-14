<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use App\Models\Ekstra;
use App\Models\Kelas;
use App\Models\Peserta;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    public function index($id)
    {
        $peserta = Peserta::with('kelas','siswa')
        ->where('ekstra_id',$id)
        ->get();

        $ekstra = Ekstra::findOrFail($id);
        $kel = Kelas::all();
        $sis = Siswa::all();

        $title = 'Hapus Peserta!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('ekstrakurikuler.peserta',compact(['peserta','ekstra','kel','sis']));
    }

    public function simpan(Request $request, $id)
    {
        $simpan = Peserta::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'ekstra_id' => $id,
            'hadir' => 0,
            'sakit' => 0,
            'ijin' => 0,
            'alpa' => 0
        ]);
        return back()->with('toast_success','Berhasil');
    }

    public function update($id, Request $request)
    {
        $peserta = Peserta::find($id);
        $peserta->update($request->except('token','_method'));
        return back()->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Peserta::find($id);
        $hapus->delete();
        return back()->with('toast_success','Berhasil');
    }

    public function reset($ekstra_id)
    {
        // Lakukan logika reset kehadiran di sini, misalnya mengatur ulang nilai-nilai pada tabel peserta

        // Contoh: Mengatur ulang semua nilai hadir, sakit, ijin, dan alpa menjadi 0
        Peserta::where('ekstra_id', $ekstra_id)->update(['hadir' => 0, 'sakit' => 0, 'ijin' => 0, 'alpa' => 0, 'predikat' => "-", 'deskripsi' => "-"]);

        return redirect()->back()->with('toast_success', 'Data kehadiran berhasil direset.');
    }

    public function pesertaimportexcel(Request $request)
    {
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataPeserta', $namafile);

        Excel::import(new PesertaImport, base_path('DataPeserta/' . $namafile));

        return redirect()->route('sis')->with('toast_success', 'Berhasil Import Data');;
    }
}
