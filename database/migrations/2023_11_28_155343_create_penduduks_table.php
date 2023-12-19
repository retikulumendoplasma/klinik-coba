<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->string("nik")->primary();
            $table->string('nomor_kk');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['laki-laki','perempuan']);
            $table->string('agama');
            $table->string('alamat');
            $table->string('nomor_hp');
            $table->enum('status_perkawinan',['menikah','belum_menikah']);
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status_hubungan_kk');
            $table->enum('status_akun',['terdaftar','belum_terdaftar'])->default('belum terdaftar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
}
