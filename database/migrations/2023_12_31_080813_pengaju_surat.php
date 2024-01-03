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
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('foto_ktp');
            $table->string('foto_kk');
            $table->enum('status_perkawinan',['Menikah','Belum Menikah']);
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('foto_pendukung')->nullable();
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