<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EkstraController extends Controller
{
    public function index()
    {
        $ekstra =DB::table('ekstra')
        ->get();

        //dd($admin);
        return  view('ekstrakurikuler.ekstra',compact(['ekstra']));
    }

    public function simpan(Request $request)
    {
        $simpan = Ekstra::create([
            'ekstra' => $request->ekstra
        ]);
        return  redirect('ekstra');
    }

    public function update($id, Request $request)
    {
        $ekstra = Ekstra::find($id);
        $ekstra->update($request->except('token','_method'));
        return  redirect('ekstra');
    }

    public function hapus($id)
    {
        $hapus = Ekstra::find($id);
        $hapus->delete();
        return  redirect('ekstra');
    }
}
