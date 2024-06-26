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

        $title = 'Hapus Laporan!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        //dd($admin);
        return  view('ekstrakurikuler.pelatih',compact(['pelatih','ekstra']));
    }

    public function absen(Request $request, $id)
    {
        $user = Auth::user();
        $simpan = Pelatih::create([
            'latihan' => $request->latihan,
            'kehadiran' => $request->kehadiran,
            'ekstra_id' => $id,
            'pelapor' => $user->name
        ]);
        return back()->with('toast_success','Berhasil');;
    }

    public function hapus($id)
    {
        $hapus = Pelatih::find($id);
        $hapus->delete();
        return  back()->with('toast_success','Berhasil');;
    }

    public function rekap(Request $request)
    {
        $pelatihQuery = Pelatih::with('ekstra');

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');

        // dd($pelatihQuery->toSql());

        // Menghitung jumlah kegiatan yang sesuai filter
        $jumlah = Pelatih::count();

        $pelatih = $pelatihQuery->latest()->get();
        $ekstra = Ekstra::all();

        $latihanData = [];
        $kehadiranData = [];

        // $latihanBulanIniQuery = Pelatih::where('latihan', 'Latihan');
        // $pelatihBulanIniQuery = Pelatih::where('kehadiran', 'Hadir');

        // // if ($mulai && $akhir) {
        //     $latihanBulanIniQuery->whereBetween('created_at', [$mulai, $akhir]);
        //     $pelatihBulanIniQuery->whereBetween('created_at', [$mulai, $akhir]);
        // // }

        // if ($ekstraIdFilter) {
        //     $latihanBulanIniQuery->where('ekstra_id', $ekstraIdFilter);
        //     $pelatihBulanIniQuery->where('ekstra_id', $ekstraIdFilter);
        // }

        // $latihanBulanIni[$item->id] = $latihanBulanIniQuery->count();
        // $pelatihBulanIni[$item->id] = $pelatihBulanIniQuery->count();

        foreach ($ekstra as $item) {
            $latihanBulanIniQuery = Pelatih::where('latihan', 'Latihan')->where('ekstra_id', $item->id);
            $pelatihBulanIniQuery = Pelatih::where('kehadiran', 'Hadir')->where('ekstra_id', $item->id);

            if ($mulai && $akhir) {
                $latihanBulanIniQuery->whereBetween('created_at', [$mulai, $akhir]);
                $pelatihBulanIniQuery->whereBetween('created_at', [$mulai, $akhir]);
            }

            $latihanData[$item->id] = $latihanBulanIniQuery->count();
            $kehadiranData[$item->id] = $pelatihBulanIniQuery->count();
        }

        return  view('rekap.ekskul', compact(['pelatih','ekstra','jumlah','latihanData','kehadiranData']));
    }
}
