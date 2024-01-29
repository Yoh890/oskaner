<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $user =DB::table('users')
        ->get();

        //dd($admin);
        return  view('pengguna',compact(['user']));
    }

    public function simpan(Request $request)
    {
        $simpan = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);
        return  redirect('pengguna');
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->except('token','_method'));
        return  redirect('pengguna');
    }

    public function hapus($id)
    {
        $hapus = User::find($id);
        $hapus->delete();
        return  redirect('pengguna');
    }
}
