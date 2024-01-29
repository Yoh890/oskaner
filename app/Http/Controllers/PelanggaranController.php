<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $pelan = DB::table('pelanggaran')->get();

        //dd($admin);
        return  view('pelanggaran.index',compact(['pelan']));
    }

    public function tambah()
    {
        return  view('pelanggaran.tambah');
    }

    public function simpan(Request $request)
    {
        $simpan = Pelanggaran::create([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point
        ]);
        return  redirect('pelanggaran');
    }

    public function ubah($id)
    {
        $pelanggaran = Pelanggaran::find($id);
        return  view('pelanggaran.edit',compact(['pelanggaran']));
    }

    public function update($id, Request $request)
    {
        $pelanggaran = Pelanggaran::find($id);
        $pelanggaran->update($request->except('token','_method'));
        return  redirect('pelanggaran');
    }

    public function hapus($id)
    {
        $hapus = Pelanggaran::find($id);
        $hapus->delete();
        return  redirect('pelanggaran');
    }
}
