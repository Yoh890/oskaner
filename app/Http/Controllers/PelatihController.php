<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelatihController extends Controller
{
    public function index($id)
    {
        $pelatih = Pelatih::with('ekstra')
        ->where('ekstra_id', $id)
        ->latest()
        ->get();
        $ekstra = Ekstra::findOrFail($id);

        //dd($admin);
        return  view('ekstrakurikuler.pelatih',compact(['pelatih','ekstra']));
    }

    public function absen(Request $request, $id)
    {
        $user = Auth::user();
        $simpan = Pelatih::create([
            'kehadiran' => $request->kehadiran,
            'ekstra_id' => $id,
            'pelapor' => $user->name
        ]);
        return back();
    }

    public function hapus($id)
    {
        $hapus = Pelatih::find($id);
        $hapus->delete();
        return  back();
    }

    public function rekap(Request $request)
    {
        $pelatihQuery = Pelatih::with('ekstra');

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');
        if ($mulai && $akhir) {
            $pelatihQuery->whereBetween('created_at', [$mulai, $akhir]);
        }

        $ekstraIdFilter = $request->input('ekskul');
        if ($ekstraIdFilter) {
            $pelatihQuery->where('ekstra_id', $ekstraIdFilter);
        }
        // dd($pelatihQuery->toSql());

        $pelatih = $pelatihQuery->latest()->get();
        $ekstra = Ekstra::all();
        return  view('rekap.ekskul', compact(['pelatih','ekstra']));
    }
}
