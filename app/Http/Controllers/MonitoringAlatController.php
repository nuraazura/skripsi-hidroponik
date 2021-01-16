<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogMonitoring;
use App\Monitoring;
use App\Alat;

class MonitoringAlatController extends Controller
{
    
    public function logMonitoring(Request $request, $kode_alat_id, $suhu_udara, $kelembapan, $nutrisi){
        $input['kode_alat_id']  = $request->kode_alat_id;
        $input['suhu_udara']    = $request->suhu_udara;
        $input['kelembapan']    = $request->kelembapan;
        $input['nutrisi']       = $request->nutrisi;
        $kode_alat_id  =  LogMonitoring::where('kode_alat_id',$input['kode_alat_id'])->first();
        $simpan = LogMonitoring::create($input);
        
        return ($input);
    }

    public function monitoring(Request $request, $kode_alat_id, $suhu_udara, $kelembapan, $nutrisi){
        $input['kode_alat_id']  = $request->kode_alat_id;
        $input['suhu_udara']    = $request->suhu_udara;
        $input['kelembapan']    = $request->kelembapan;
        $input['nutrisi']       = $request->nutrisi;
        $kode_alat_id  =  Monitoring::where('kode_alat_id',$input['kode_alat_id'])->first();
        //jika node sensor blm ada maka di buat
        if (empty($kode_alat_id)) {
            $simpan = Monitoring::create($input);
        }
        //jika node sensor sudah ada maka di update
        if (isset($kode_alat_id)) {
            $id = $kode_alat_id->id;
            $update = Monitoring::find($id)->update($input);
        }
        
        return ($input);

    }

    public function getData($user_id)
    {
        $kodeAlat = Alat::where('user_id', $user_id)->pluck('kode_alat')->toArray();
        $monitoring = Monitoring::whereIn('kode_alat', $kodeAlat)->get();
        
        return response()->json($monitoring, 200);
    }

}