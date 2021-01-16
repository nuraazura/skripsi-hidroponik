<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_monitoring', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->nullable();
            $table->float('kelembapan_air')->nullable();
            $table->float('suhu_air')->nullable();
            $table->float('nutrisi_air')->nullable();
            $table->float('suhu_udara')->nullable();
            $table->float('kelembaban_udara')->nullable();
            $table->boolean('kipas_pendingin')->nullable();
            // $table->boolean('kipas_pemanas')->nullable();
            $table->boolean('pompa_nutrisi')->nullable();
            $table->boolean('pompa_air')->nullable();
            $table->boolean('pompa_siram')->nullable();
            $table->boolean('lampu_led')->nullable();
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
        Schema::dropIfExists('log_monitoring');
    }
}
