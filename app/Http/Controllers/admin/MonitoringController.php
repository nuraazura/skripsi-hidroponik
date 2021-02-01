<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;
use App\Helpers;
use App\User;
use App\Alat;
use App\LogMonitoring;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = User::where('level','=','petani')->get();
        return view ('admin.monitoring.index', compact('level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftarAlat($user_id)
    {
        $alats = Alat::where('user_id', $user_id)->get();
        // return $alats;
        
        return view('admin.monitoring.daftar_alat', compact('alats', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function log($id)
    {
       $alat = Alat::where('kode_alat', $id)->first();
       $log_monitoring = LogMonitoring::where('kode_alat', $alat->kode_alat)->get();
    //    return ($log_monitoring); 
       return view('admin.monitoring.log_monitoring', compact('log_monitoring', 'alat'));  

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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            ->addColumn('suhu_ruangan', function($data){
                return $data->suhu_udara.' <sup>0 </sup>C';
            })
            ->addColumn('kelembaban_udara', function($data){
                return $data->kelembaban_udara.' %';
            })
            ->editColumn('nutrisi_air', function($data){
                return $data->nutrisi_air.' ppm';
            })
            // ->editColumn('suhu_air', function($data){
            //     return $data->suhu_air.' <sup>0 </sup>C';
            // })
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
            ->editColumn('pompa_nutrisi', function($data){
                if ($data->pompa_nutrisi == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->pompa_nutrisi).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->pompa_nutrisi).'</span>';
                }
            })
            ->editColumn('pompa_air', function($data){
                if ($data->pompa_air == 1) {
                    return '<span class="badge badge-success">'.Helpers::statusKontrol($data->pompa_air).'</span>';
                } else {
                    return '<span class="badge badge-danger">'.Helpers::statusKontrol($data->pompa_air).'</span>';
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
                // 'suhu_air',
                'pompa_siram',
                'kipas_pendingin',
                // 'kipas_pemanas',
                'pompa_nutrisi',
                'pompa_air',
                'lampu_led',
            ])
            ->make(true);
    }
}