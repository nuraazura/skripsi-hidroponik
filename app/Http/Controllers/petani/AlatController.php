<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alat;
use App\User;
use App\Kontrol;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        // return ($user);
        return view ('petani.kendali.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'suhu_udara_min'    => 'required',
            'suhu_udara_max'    => 'required',
            'kelembapan_min'    => 'required',
            // 'kelembapan_max'    => 'required',
            'nutrisi_min'       => 'required',
            'nutrisi_max'       => 'required',
            'lampu_hidup'       => 'required',
            'lampu_mati'        => 'required',
        ]);

        $data = new Kontrol;
        // $data->suhu_udara_min = $request->input ('suhu_udara_min');
        $data->suhu_udara_max = $request->input ('suhu_udara_max');
        $data->kelembapan_min = $request->input ('kelembapan_min');
        // $data->kelembapan_max = $request->input ('kelembapan_max');
        $data->nutrisi_min = $request->input ('nutrisi_min');
        $data->nutrisi_max = $request->input ('nutrisi_max');
        $data->lampu_hidup = $request->input ('lampu_hidup');
        $data->lampu_mati = $request->input ('lampu_mati');
        $data->save();
        
        alert()->success('Pengguna Berhasil Disimpan');
        return redirect ()->route ('petani.kendali.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // $data = Alat::where('id', $id)->auth()->user()->id->get(); 
        // return ($data);
        return view('petani.kendali.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            // 'suhu_udara_min'    => 'required',
            'suhu_udara_max'    => 'required',
            'kelembapan_min'    => 'required',
            // 'kelembapan_max'    => 'required',
            'nutrisi_min'       => 'required',
            'nutrisi_max'       => 'required',
            'lampu_hidup'       => 'required',
            'lampu_mati'        => 'required',
        ]);

        $data = Alat::findOrFail($id);
        // $data->suhu_udara_min = $request('suhu_udara_min');
        $data->suhu_udara_max = $request ('suhu_udara_max');
        $data->kelembapan_min = $request ('kelembapan_min');
        // $data->kelembapan_max = $request ('kelembapan_max');
        $data->nutrisi_min = $request ('nutrisi_min');
        $data->nutrisi_max = $request ('nutrisi_max');
        $data->lampu_hidup = $request ('lampu_hidup');
        $data->lampu_mati = $request ('lampu_mati');
        $data->update();
        
        alert()->success('Pengguna Berhasil Disimpan');
        return redirect ()->route ('petani.kendali.index');
    }
}
