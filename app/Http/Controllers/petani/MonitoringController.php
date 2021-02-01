<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\User;
use Auth;
use App\LogMonitoring;
use App\Helpers;
use App\Alat;
use Carbon\Carbon;

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

        if ($mulai != null && $akhir != null) {
            $data = DB::select('SELECT * 
            FROM log_monitoring 
            WHERE kode_alat = "'.$kode_alat.'" AND
            created_at >= "'.date('Y-m-d 00:00:00', strtotime($mulai)).'" AND
            created_at <= "'.date('Y-m-d 00:00:00', strtotime($akhir.' +1 day')).'" AND
            created_at IN ( SELECT MIN(created_at) AS created_at
                          FROM log_monitoring
                          GROUP BY DATE_FORMAT(created_at,"%Y-%m-%d %H:%i:00") + 
                         INTERVAL (MINUTE(created_at) - MINUTE(created_at) MOD 1) MINUTE ) ORDER BY id DESC');
        } else {
            $data = DB::select('SELECT * 
            FROM log_monitoring 
            WHERE kode_alat = "'.$kode_alat.'" AND
            created_at IN ( SELECT MIN(created_at) AS created_at
                          FROM log_monitoring
                          GROUP BY DATE_FORMAT(created_at,"%Y-%m-%d %H:%i:00") + 
                         INTERVAL (MINUTE(created_at) - MINUTE(created_at) MOD 1) MINUTE ) ORDER BY id DESC');
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_tanaman', function($data){
                $alat = Alat::where('kode_alat', $data->kode_alat)->first();
                return $alat->nama_tanaman;
            })
            ->addColumn('usia_tanaman', function($data){
                $alat = Alat::where('kode_alat', $data->kode_alat)->first();
                return Helpers::dateDiffLogMonitoring($alat->created_at, $data->created_at). ' Hari';
            })
            ->addColumn('waktu_pembacaan', function($data){
                return date('d M Y H:i:s', strtotime($data->created_at));
            })
            ->editColumn('kelembapan_air', function($data){
                return $data->kelembapan_air. ' %';
            })
            ->editColumn('nutrisi_air', function($data){
                return $data->nutrisi_air.' ppm';
            })
            ->editColumn('suhu_air', function($data){
                return $data->suhu_air.' <sup>0 </sup>C';
            })
            ->addColumn('suhu_ruangan', function($data){
                return $data->suhu_udara.' <sup>0 </sup>C';
            })
            ->addColumn('kelembaban_udara', function($data){
                return $data->kelembaban_udara.' %';
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
            ->editColumn('pompa_air', function($data){
                if ($data->pompa_air == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->pompa_air).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->pompa_air).'</span>';
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
                'suhu_ruangan',
                'kelembaban_udara',
                'kelembapan_air',
                'nutrisi_air',
                'suhu_air',
                'pompa_siram',
                'kipas_pendingin',
                'pompa_air',
                'pompa_nutrisi',
                'lampu_led',
            ])
            ->make(true);
    }
}
