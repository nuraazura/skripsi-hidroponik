<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_alat',
        'user_id',
        'suhu_udara_min',
        'suhu_udara_max',
        'kelembapan_min',
        'kelembapan_max',
        'nutrisi_min',
        'nutrisi_max',
        'lampu_hidup',
        'lampu_mati',
        'waktu_penyiraman_mulai',
        'waktu_penyiraman_selesai',
    ];

    public function log_monitoring()
    {
        return $this->hasMany('App\LogMonitoring', 'kode_alat', 'kode_alat');
    }
}
