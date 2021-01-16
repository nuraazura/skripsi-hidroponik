<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrol', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->nullable();
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
        Schema::dropIfExists('kontrol');
    }
}
