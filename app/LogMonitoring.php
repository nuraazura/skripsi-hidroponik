<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogMonitoring extends Model
{
    protected $table = "log_monitoring";
    protected $primaryKey = 'id';
    protected $fillable = [
        // 'user_id',
        'kode_alat',
        'kelembapan_air',
        'nutrisi_air',
        'suhu_air',
        'suhu_udara',
        'kelembaban_udara',
        'created_at',
        'kipas_pendingin',
        // 'kipas_pemanas',
        'pompa_nutrisi',
        'pompa_air',
        'pompa_siram',
        'lampu_led',
    ];

    public function alat()
    {
        return $this->belongsTo('App\Alat','kode_alat','kode_alat');
    }
}
