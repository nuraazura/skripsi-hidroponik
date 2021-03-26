<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Kontrol;

class KendaliController extends Controller
{
    public function statusKontrol($kodeAlat)
    {
        $data = Kontrol::where('kode_alat', $kodeAlat)->first();

        $statusKipasPendingin   = $data->kipas_pendingin;
        $statusPompaNutrisi     = $data->pompa_nutrisi;
        $statusPompaAir         = $data->pompa_air;
        $statusPompaSiram       = $data->pompa_siram;
        $statusLampuLed         = $data->lampu_led;

        $status = $statusKipasPendingin.'.'.$statusPompaNutrisi.'.'.$statusPompaAir.'.'.$statusPompaSiram.'.'.$statusLampuLed;

        return response()->json($status, 200);
    }
    // public function kipasPendingin($kodeAlat)
    // {
    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->kipas_pendingin;
    //     return response()->json($status, 200);
    // }

    // public function kipasPemanas($kodeAlat)
    // {
    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->kipas_pemanas;
    //     return response()->json($status, 200);
    // }

    // public function led($kodeAlat)
    // {
        // lampu led
        // $alat = Alat::where('kode_alat', $kodeAlat)->first();

        // $timeNow = date('H:i:s');
        // if ($timeNow >= $alat->lampu_hidup_1 && $timeNow < $alat->lampu_mati_1) {
        //     // led hidup
        //     $kontrol['lampu_led'] = 1;
        // } else if ($timeNow >= $alat->lampu_hidup_2 && $timeNow < $alat->lampu_mati_2) {
        //     // led hidup
        //     $kontrol['lampu_led'] = 1;
        // } else {
        //     // led mati
        //     $kontrol['lampu_led'] = 0;
        // }

        // Kontrol::updateOrCreate(['kode_alat' => $kodeAlat], $kontrol);

    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->lampu_led;
    //     return response()->json($status, 200);
    // }

    // public function pompaSiram($kodeAlat)
    // {
    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->pompa_siram;
    //     return response()->json($status, 200);
    // }

    // public function pompaNutrisi($kodeAlat)
    // {
    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->pompa_nutrisi;
    //     return response()->json($status, 200);
    // }

    // public function pompaAir($kodeAlat)
    // {
    //     $status = Kontrol::where('kode_alat', $kodeAlat)->first()->pompa_air;
    //     return response()->json($status, 200);
    // }

   
}
