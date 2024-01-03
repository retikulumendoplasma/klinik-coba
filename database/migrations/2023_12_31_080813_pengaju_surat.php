<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengajuSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaju_surat', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat',['Surat keterangan tidak mampu', 'Surat keterangan meninggal dunia', 'Surat keterangan domisili', 'Surat keterangan belum/sudah menikah']);
            $table->string('nik');
            $table->string('nomor_kk');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('agama');
            $table->string('alamat');
            $table->string('nomor_hp');
            $table->enum('status_perkawinan',['Menikah','Belum Menikah']);
            $table->string('pekerjaan');
            $table->enum('status_surat',['Proses','Selesai']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaju_surat');
    }
}