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
        $kelasIdFilter = $request->input('kelas');
        $siswa = Siswa::with('kelas')
            ->where('kelas_id', $kelasIdFilter)
            ->get();
        // if ($kelasIdFilter) {
        //     $siswaQuery->where('kelas_id', $kelasIdFilter);
        // }

        // $siswa = $siswaQuery->get();
        $kel = Kelas::all();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

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

        $title = 'Hapus Laporan!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return  view('view',compact(['siswa','prestasi','laporan','hitpres','ek']));
    }

    public function simpan(Request $request)
    {
        $simpan = Siswa::create([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'point' => 0
        ]);
        return  redirect('siswa')->with('toast_success','Berhasil');
    }

    public function update($id, Request $request)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->except('token','_method'));
        return  redirect('siswa')->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Siswa::find($id);
        $hapus->delete();
        return  redirect('siswa')->with('toast_success','Berhasil');
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

    return back()->with('toast_success','Berhasil');
    }

    public function naikKelasMassal(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas_asal' => 'required|exists:kelas,id',
            'kelas_tujuan' => 'required',
        ]);

        // Cari semua siswa di kelas asal
        $siswa = Siswa::where('kelas_id', $request->input('kelas_asal'))->get();

        // Update kelas siswa
        if ($request->input('kelas_tujuan') == 'lulus') {
            foreach ($siswa as $sis) {
                // Hapus data siswa
                $sis->delete();
                // Hapus data dari tabel terkait
                // Laporan::where('siswa_id', $sis->id)->delete();

            }

            return back();
        } else {
        foreach ($siswa as $sis) {
            $sis->kelas_id = $request->input('kelas_tujuan');
            $sis->save();

            // Perbarui kelas di tabel laporan
            Laporan::where('siswa_id', $sis->id)->update(['kelas_id' => $request->input('kelas_tujuan')]);

            // Perbarui kelas di tabel peserta
            Peserta::where('siswa_id', $sis->id)->update(['kelas_id' => $request->input('kelas_tujuan')]);

            // Perbarui kelas di tabel prestasi
            Prestasi::where('siswa_id', $sis->id)->update(['kelas_id' => $request->input('kelas_tujuan')]);

        }

        return back()->with('toast_success','Berhasil');
    }
    }

}
