<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alat; 
use App\User;
use App\LogMonitoring;

class BerandaController extends Controller
{
    public function index()
    {
        $alat = Alat::count();
        $user = User::where('level', 'petani')->count();
        $today = date('Y-m-d');
        $dateCreate = date_create($today);
        $jam = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
        
        foreach ($jam as $key => $v) {

            $dateTimeStart = date_time_set($dateCreate, $v, 00);
            $timeStart = date_format($dateTimeStart, 'Y-m-d H:i:s');

            $dateTimeEnd = date_time_set($dateCreate, $v+1, 00);
            $timeEnd = date_format($dateTimeEnd, 'Y-m-d H:i:s');

            $data['suhu_udara'][] = LogMonitoring::where('created_at', 'like', '%'.$today.'%')
                    ->where('created_at', '>', $timeStart)
                    ->where('created_at', '<', $timeEnd)
                    ->avg('suhu_udara');
            $data['nutrisi_air'][] = LogMonitoring::where('created_at', 'like', '%'.$today.'%')
                    ->where('created_at', '>', $timeStart)
                    ->where('created_at', '<', $timeEnd)
                    ->avg('nutrisi_air');
            $data['kelembapan_air'][] = LogMonitoring::where('created_at', 'like', '%'.$today.'%')
                    ->where('created_at', '>', $timeStart)
                    ->where('created_at', '<', $timeEnd)
                    ->avg('kelembapan_air');
            
        }

        // return $jam;
        return view ('admin.beranda.index', compact('alat','user', 'data', 'jam'));
    }
}
