<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_tanaman')->nullable();
            // $table->float('suhu_udara_min')->nullable();
            $table->float('suhu_udara_max')->nullable();
            $table->float('kelembapan_min')->nullable();
            // $table->float('kelembapan_max')->nullable();
            $table->float('nutrisi_min')->nullable();
            $table->float('nutrisi_max')->nullable();
            $table->time('lampu_hidup')->nullable();
            $table->time('lampu_mati')->nullable();
            $table->time('waktu_penyiraman_mulai')->nullable();
            $table->time('waktu_penyiraman_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat');
    }
}
