<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontrol extends Model
{
    protected $table = 'kontrol';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_alat',
        'kipas_pendingin',
        // 'kipas_pemanas',
        'pompa_nutrisi',
        'pompa_air',
        'pompa_siram',
        'lampu_led',
    ];
}
