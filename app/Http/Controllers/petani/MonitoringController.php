<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use Auth;
use App\LogMonitoring;
use App\Helpers;
use App\Alat;

class MonitoringController extends Controller
{
    public function index()
    {   
        $now = date('Y-m-d');
        $user = auth()->user()->id;
        $data_alat = Alat::where('user_id', $user)->get();
        
        return view ('petani.monitoring.index', compact('user','data_alat'));
    }

    public function log($kode_alat)
    {
       $alat = Alat::with('log_monitoring')->where('kode_alat', $kode_alat)->first();
        
       return view('petani.monitoring.log_monitoring', compact('alat'));  

    }

    public function get_data(Request $request, $kode_alat)
    {
        $mulai = $request->tanggal_mulai;
        $akhir = $request->tanggal_akhir;

        $data = LogMonitoring::where('kode_alat', $kode_alat)->orderBy('id', 'DESC');

        if ($mulai != null && $akhir != null) {
        $data->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($mulai)), date('Y-m-d 23:59:59', strtotime($akhir))]);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_tanaman', function($data){
                return $data->alat->nama_tanaman;
            })
            ->addColumn('usia_tanaman', function($data){
                return Helpers::dateDiff($data->created_at). ' Hari';
            })
            ->addColumn('waktu_pembacaan', function($data){
                return $data->created_at->format('d M Y H:i');
            })
            ->editColumn('kelembapan_air', function($data){
                return $data->kelembapan_air. ' %';
            })
            ->addColumn('suhu_ruangan', function($data){
                return $data->suhu_udara.' <sup>0 </sup>C';
            })
            ->editColumn('nutrisi_air', function($data){
                return $data->nutrisi_air.' ppm';
            })
            ->editColumn('pompa_siram', function($data){
                if ($data->pompa_siram == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->pompa_siram).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->pompa_siram).'</span>';
                }
            })
            ->editColumn('kipas_pendingin', function($data){
                if ($data->kipas_pendingin == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->kipas_pendingin).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->kipas_pendingin).'</span>';
                }
            })
            ->editColumn('kipas_pemanas', function($data){
                if ($data->kipas_pemanas == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->kipas_pemanas).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->kipas_pemanas).'</span>';
                }
            })
            ->editColumn('pompa_nutrisi', function($data){
                if ($data->pompa_nutrisi == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->pompa_nutrisi).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->pompa_nutrisi).'</span>';
                }
            })
            ->editColumn('lampu_led', function($data){
                if ($data->lampu_led == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->lampu_led).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->lampu_led).'</span>';
                }
            })
            ->rawColumns([
                // 'DT_RowIndex',
                'nama_tanaman', 
                'usia_tanaman', 
                'waktu_pembacaan', 
                'kelembapan_air',
                'suhu_ruangan',
                'pompa_siram',
                'kipas_pendingin',
                'kipas_pemanas',
                'pompa_nutrisi',
                'lampu_led',
            ])
            ->make(true);
    }
}
