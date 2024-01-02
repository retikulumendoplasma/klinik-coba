<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BalasanSaranDanMasukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balasan_saran_dan_masukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_isi_saran');
            $table->text('isi_balasan_saran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balasan_saran_dan_masukan');
    }
}
