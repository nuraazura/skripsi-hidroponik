<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoring;
use App\LogMonitoring;
use App\Alat;
use App\Kontrol;

class KirimDataController extends Controller
{
    public function kirim_data($kodeAlat, $kelembapan_air, $nutrisi_air, $suhu_air, $suhu_udara, $kelembaban_udara)
    {
        $log = []; // deklarasi variabel array
        $timeNow = date('H:i:s'); // deklarasi variabel waktu
        $input = [
            'kode_alat'         => $kodeAlat,
            'kelembapan_air'    => $kelembapan_air,
            'nutrisi_air'       => $nutrisi_air,
            'suhu_air'          => $suhu_air,
            'suhu_udara'        => $suhu_udara,
            'kelembaban_udara'  => $kelembaban_udara,
        ];

        // proses update status kontrol alat
        $alat = Alat::where('kode_alat', $input['kode_alat'])->first(); //ambil data alat berdasarkan kode alat
        
        // pompa nutrisi
        if ($input['nutrisi_air'] < $alat->nutrisi_min) {
            // pompa nutrisi aktif
            $kontrol['pompa_nutrisi'] = 1;
        } else {
            // pompa nutrisi tidak aktif     
            $kontrol['pompa_nutrisi'] = 0;
        }
        // pompa air
        if ($input['nutrisi_air'] > $alat->nutrisi_max) {
            // pompa air aktif
            $kontrol['pompa_air'] = 1;
        } else {
            // pompa air tidak aktif
            $kontrol['pompa_air'] = 0;
        }
        // logic kipas pendingin
        if ($input['suhu_udara'] > $alat->suhu_udara_max) {
            $kontrol['kipas_pendingin'] = 1;
        } else {
            $kontrol['kipas_pendingin'] = 0;
        }

        
        // lampu led
        if ($alat->lampu_hidup < $alat->lampu_mati) {
            if ($timeNow >= $alat->lampu_hidup && $timeNow < $alat->lampu_mati) {
                // led hidup
                $kontrol['lampu_led'] = 1;
            } else {
                // led mati
                $kontrol['lampu_led'] = 0;
            }
        } else {
            if ($timeNow >= $alat->lampu_hidup || $timeNow < $alat->lampu_mati) {
                // return 'hidup';
                // led hidup
                $kontrol['lampu_led'] = 1;
            } else {
                // return 'mati';
                // led mati
                $kontrol['lampu_led'] = 0;
            }

        // pompa siram
        if ($alat->waktu_penyiraman_mulai < $alat->waktu_penyiraman_selesai) {
            if ($timeNow >= $alat->waktu_penyiraman_mulai && $timeNow < $alat->waktu_penyiraman_selesai) {
                // led hidup
                $kontrol['pompa_siram'] = 1;
            } else {
                // led mati
                $kontrol['pompa_siram'] = 0;
            }
        } else {
            if ($timeNow >= $alat->waktu_penyiraman_mulai || $timeNow < $alat->waktu_penyiraman_selesai) {
                // led hidup
                $kontrol['pompa_siram'] = 1;
            } else {
                // led mati
                $kontrol['pompa_siram'] = 0;
            }
        }
        
        }
        
        Kontrol::updateOrCreate(['kode_alat' => $kodeAlat], $kontrol);

        // data untuk log
        $log = array_merge($input, $kontrol);
        
        // update data monitoring realtime
        Monitoring::updateOrCreate(['kode_alat' => $kodeAlat], $log);

        $createLog = LogMonitoring::create($log);

        return 'sucess send to server';
        return $createLog;
        
    }

    public function dataMonitoring()
    {
        $data = Monitoring::all();
        return $data;
    }

}
