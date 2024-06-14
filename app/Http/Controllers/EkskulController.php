<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Ekstra;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EkskulController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $ekskulQuery = Ekskul::with('ekstra');

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $ekskulQuery->whereBetween('tgl', [$mulai, $akhir]);
        }else {
            $ekskulQuery->where('tgl', $todayDate);
        }

        // Filter berdasarkan ekstrakurikuler
        $ekstraIdFilter = $request->input('ekskul');
        if ($ekstraIdFilter) {
            $ekskulQuery->where('ekstra_id', $ekstraIdFilter);
        }

        // Menghitung jumlah kegiatan yang sesuai filter
        $jumlah = $ekskulQuery->count();

        $ekskul = $ekskulQuery->latest()->get();
        $eks = Ekstra::all();
        $todayDate = Carbon::now()->format('Y-m-d');

        $title = 'Hapus Laporan!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('ekstrakurikuler.ekskul',compact(['ekskul','eks','jumlah']));
    }

    public function simpan(Request $request)
    {
        $user = Auth::user();
        $simpan = Ekskul::create([
            'ekstra_id' => $request->ekstra_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'pelapor' => $user->name,
            'tgl' => $request->tgl
        ]);
        return  back()->with('toast_success','Berhasil menambahkan laporan ekstrakurikuler');
    }

    public function update($id, Request $request)
    {
        $ekskul = Ekskul::find($id);
        $ekskul->update($request->except('token','_method'));
        return  back()->with('toast_success','Berhasil');
    }

    public function hapus($id)
    {
        $hapus = Ekskul::find($id);
        $hapus->delete();
        return  back()->with('toast_success','Berhasil');
    }
}
