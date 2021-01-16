<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alat;

class ManajemenAlatController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $alats = Alat::where('user_id',$user_id)->get();
        return view('petani.kendali.index', compact('alats', 'user_id'));
    }

    public function atur_tanaman($kode_alat)
    {
        $alat = Alat::where('kode_alat', $kode_alat)->first();
        return view('petani.kendali.atur_tanaman', compact('alat'));
    }

    public function update(Request $request, $id_alat)
    {
        // return $request->all();
        $data = Alat::findOrFail($id_alat);
        $data->nama_tanaman             = $request->nama_tanaman;
        $data->suhu_udara_max           = $request->suhu_udara_max;
        $data->nutrisi_min              = $request->nutrisi_min;
        $data->nutrisi_max              = $request->nutrisi_max;
        $data->lampu_hidup              = $request->lampu_hidup;
        $data->lampu_mati               = $request->lampu_mati;
        $data->waktu_penyiraman_mulai   = $request->waktu_penyiraman_mulai;
        $data->waktu_penyiraman_selesai = $request->waktu_penyiraman_selesai;
        // $data->suhu_udara_min       = $request->suhu_udara_min;
        // $data->kelembapan_min       = $request->kelembapan_min;
        // $data->kelembapan_max       = $request->kelembapan_max;
        $data->update();

        // alert()->success('Data Berhasil Diperbaharui');
        return redirect('petani/kendali')->with('success', 'Data Berhasil Diperbaharui');
    }
}
