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
        $ekskulQuery = Ekskul::with('ekstra');

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $ekskulQuery->whereBetween('tgl', [$mulai, $akhir]);
        }

        // Filter berdasarkan ekstrakurikuler
        $ekstraIdFilter = $request->input('ekskul');
        if ($ekstraIdFilter) {
            $ekskulQuery->where('ekstra_id', $ekstraIdFilter);
        }

        $ekskul = $ekskulQuery->latest()->get();
        $eks = Ekstra::all();
        $todayDate = Carbon::now()->format('Y-m-d');

        //dd($admin);
        return  view('ekstrakurikuler.ekskul',compact(['ekskul','eks']));
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
        return  redirect('ekskul')->with('toast_success','Berhasil menambahkan laporan ekkstrakurikuler');
    }

    public function update($id, Request $request)
    {
        $ekskul = Ekskul::find($id);
        $ekskul->update($request->except('token','_method'));
        return  redirect('ekskul');
    }

    public function hapus($id)
    {
        $hapus = Ekskul::find($id);
        $hapus->delete();
        return  redirect('ekskul');
    }
}
