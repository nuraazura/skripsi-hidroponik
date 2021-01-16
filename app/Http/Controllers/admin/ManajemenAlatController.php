<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
use App\Alat;

class ManajemenAlatController extends Controller
{
    public function index($user_id)
    {
        $alats = Alat::where('user_id', $user_id)->get();

        return view('admin.manajemen_alat.index', compact('alats', 'user_id'));
    }

    public function store(Request $request, $user_id)
    {
        // return $request->all();
        $input = [
            'kode_alat' => $request->kode_alat,
            'user_id' => $user_id
        ];

        Alat::create($input);

        // alert()->success('Alat Berhasil Ditambahkan');
        return redirect()->back()->with('success','Alat Berhasil Ditambahkan');
    }

    public function destroy($alat_id)
    {
        $alat = Alat::find($alat_id);
        $alat->delete();

        // alert()->success('Alat Berhasil Dihapus');
        return redirect()->back()->with('success','Alat Berhasil Dihapus');
    }

    public function get_kode()
    {
        $alat = Alat::orderBy('id', 'desc')->first();

        if (!$alat) {
            $kode_alat = 'A_1';
        } else {
            $kode = $alat->kode_alat;
            $split = explode('_', $kode);
            $angka = $split[1];
            $kode_baru = $angka + 1;
            $kode_alat = 'A_'.$kode_baru;
        }

        return $kode_alat;
    }
}
