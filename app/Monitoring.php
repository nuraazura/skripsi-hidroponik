<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'monitoring';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_alat',
        // 'user_id',
        'kelembapan_air',
        'nutrisi_air',
        'suhu_air',
        'suhu_udara',
        'kelembaban_udara',
        'kipas_pendingin',
        // 'kipas_pemanas',
        'pompa_nutrisi',
        'pompa_air',
        'pompa_siram',
        'lampu_led',
        'created_at',
    ];

    public function alat ()
    {
        return $this->belongsTo('App\Alat', 'kode_alat');
    }


}
