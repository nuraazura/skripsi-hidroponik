<?php

namespace App;
use DB;

class Helpers
{
    public static function tes()
    {
        return 'test success';
    }

    public static function dateDiff($startDate, $kodeAlat)
    {
        $logMonitoring = DB::table('log_monitoring')->where('kode_alat', $kodeAlat)->orderBy('id', 'desc')->first();
        $dataLast = date('d-m-Y', strtotime($logMonitoring->created_at));

        if ($startDate) {
            $now = $dataLast;
            $start = strtotime(date('d-m-Y', strtotime($startDate)));
            $diff = strtotime($now) - $start;
    
            return abs(round($diff / 86400));
        } else {
            return '0';
        }
        
    }

    public static function dateDiffLogMonitoring($startDate, $endDate)
    {
        if ($startDate) {
            $now = $endDate;
            $start = strtotime(date('d-m-Y', strtotime($startDate)));
            $diff = strtotime($now) - $start;
    
            return abs(round($diff / 86400));
        } else {
            return '0';
        }
        
    }

    public static function statusKontrol($status)
    {
        if ($status == 1) {
            return 'Hidup';
        } else if ($status == 0) {
            return 'Mati';
        } else {
            return 'NULL';
        }
        
    }
}
