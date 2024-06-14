<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $kelas =DB::table('kelas')
        ->get();

        $title = 'Hapus Kelas!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('kelas.index',compact(['kelas']));
    }

    public function tambah()
    {
        return  view('kelas.tambah');
    }

    public function simpan(Request $request)
    {
        $simpan = Kelas::create([
            'kelas' => $request->kelas
        ]);
        return  back()->with('toast_sukses','Berhasil Menambah Kelas');
    }

    public function ubah($id)
    {
        $kelas = Kelas::find($id);
        return  view('kelas.edit',compact(['kelas']));
    }

    public function update($id, Request $request)
    {
        $kelas = Kelas::find($id);
        $kelas->update($request->except('token','_method'));
        return  back()->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Kelas::find($id);
        $hapus->delete();
        return  back()->with('toast_success','Berhasil');
    }
}
