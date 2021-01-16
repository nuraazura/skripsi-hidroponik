<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alat;
use App\LogMonitoring;
use App\Kontrol;

class BerandaController extends Controller
{
    public function index()
    {
        $kodeAlat = [];
        $statusGrowLight = [];
        $jumlahAlat = 0;
        $suhuUdaraRata = 0;
        $nutrisiAirRata = 0;
        $kelembapanAirRata = 0;

        $id_user = auth()->user()->id;
        $alat = Alat::where('user_id', $id_user);
        
        $kodeAlat = $alat->pluck('kode_alat'); // get kode alat simpan ke array

        if (count($kodeAlat) > 0) {
            $kontrols = Kontrol::whereIn('kode_alat', $kodeAlat)->get();
    
            foreach ($kontrols as $key => $value) {
                $statusGrowLight[$key]['kode_alat'] = $value->kode_alat;
                $statusGrowLight[$key]['status'] = $value->lampu_led;
            }
    
            $jumlahAlat = $alat->count(); // jumlah alat
    
            $today =  date("Y-m-d");
            $logMonitoring = LogMonitoring::where("created_at", "like", "%".$today."%")->get();
            $suhuUdaraRata = $logMonitoring->average('suhu_udara');
            $nutrisiAirRata = $logMonitoring->average('nutrisi_air');
            $kelembapanAirRata = $logMonitoring->average('kelembapan_air');
        }
        
        return view('petani.beranda.index', compact(['jumlahAlat', 'suhuUdaraRata', 'nutrisiAirRata', 'kelembapanAirRata', 'statusGrowLight']));

    }
}
