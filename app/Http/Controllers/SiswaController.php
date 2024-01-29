<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Imports\SiswaImport;
use App\Models\Laporan;
use App\Models\Pelanggaran;
use App\Models\Peserta;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{

    public function index(Request $request)
    {
        $siswaQuery = Siswa::with('kelas');
        $kelasIdFilter = $request->input('kelas');
        if ($kelasIdFilter) {
            $siswaQuery->where('kelas_id', $kelasIdFilter);
        }

        $siswa = $siswaQuery->get();
        $kel = Kelas::all();

        //dd($admin);
        return  view('siswa.index',compact(['siswa','kel']));
    }

    public function view($id)
    {
        $siswa = Siswa::where('id',$id)->first();
        $prestasi = Prestasi::where('siswa_id',$id)->get();
        $hitpres = Prestasi::where('siswa_id',$id)->count();
        $laporan = Laporan::where('siswa_id',$id)->get();
        $ek = Peserta::where('siswa_id',$id)->count();
        return  view('view',compact(['siswa','prestasi','laporan','hitpres','ek']));
    }

    public function simpan(Request $request)
    {
        $simpan = Siswa::create([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'point' => $request->point
        ]);
        return  redirect('siswa');
    }

    public function update($id, Request $request)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->except('token','_method'));
        return  redirect('siswa');
    }

    public function hapus($id)
    {
        $hapus = Siswa::find($id);
        $hapus->delete();
        return  redirect('siswa');
    }

    public function siswaimportexcel(Request $request)
    {
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataSiswa', $namafile);

        Excel::import(new SiswaImport, base_path('DataSiswa/' . $namafile));

        return redirect()->route('sis')->with('toast_success', 'Berhasil Import Data');;
    }

    public function rekap()
    {
        $siswa = Siswa::with('kelas')
        ->orderBy('point', 'desc')
        ->take(10)
        ->get();

        return view ('rekap.pelanggaran', compact('siswa'));
    }

    public function reset()
    {
    DB::table('siswa')->update(['point' => 0]);

    return back();
    }

}
