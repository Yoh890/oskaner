<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatanQuery = DB::table('kegiatan');

        // Filter berdasarkan tanggal
        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $kegiatanQuery->whereBetween('tgl', [$mulai, $akhir]);
        }

        $kegiatan = $kegiatanQuery->latest()->get();

        //dd($admin);
        return  view('osis.index',compact(['kegiatan']));
    }

    public function simpan(Request $request)
    {
        $simpan = Kegiatan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'tgl' => $request->tgl
        ]);
        return  redirect('kegiatan')->with('toast_success','Berhasil menambahkan laporan kegiatan');
    }

    public function update($id, Request $request)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->update($request->except('token','_method'));
        return  redirect('kegiatan');
    }

    public function hapus($id)
    {
        $hapus = Kegiatan::find($id);
        $hapus->delete();
        return  redirect('kegiatan');
    }
}
