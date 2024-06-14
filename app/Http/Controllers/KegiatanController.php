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
        $todayDate = Carbon::now()->format('Y-m-d');
        $kegiatanQuery = DB::table('kegiatan');

        // Filter berdasarkan tanggal
        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $kegiatanQuery->whereBetween('tgl', [$mulai, $akhir]);
        }else {
            $kegiatanQuery->where('tgl', $todayDate);
        }

        // Menghitung jumlah kegiatan yang sesuai filter
        $jumlah = $kegiatanQuery->count();

        $kegiatan = $kegiatanQuery->latest()->get();

        $title = 'Hapus Laporan!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('osis.index',compact(['kegiatan','jumlah']));
    }

    public function simpan(Request $request)
    {
        $simpan = Kegiatan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'tgl' => $request->tgl
        ]);
        return  back()->with('toast_success','Berhasil menambahkan laporan kegiatan');
    }

    public function update($id, Request $request)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->update($request->except('token','_method'));
        return  back()->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Kegiatan::find($id);
        $hapus->delete();
        return  back()->with('toast_success','Berhasil');
    }
}
