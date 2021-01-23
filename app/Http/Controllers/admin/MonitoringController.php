<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Helpers;
use App\user;
use App\alat;
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
                return Helpers::dateDiffLogMonitoring($data->alat->created_at, $data->created_at). ' Hari';
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