<?php

namespace App;

class Helpers
{
    public static function tes()
    {
        return 'test success';
    }

    public static function dateDiff($startDate)
    {
        if ($startDate) {
            $now = date('d-m-Y');
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
