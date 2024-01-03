<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengajuProposalTender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaju_proposal_tender', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tender');
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_hp');
            $table->string('nama');
            $table->binary('file_proposal');
            $table->binary('foto_pengaju');
            $table->date('tanggal_lahir');
            $table->enum('status_pengajuan',['pending','ditolak','Perempuan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaju_proposal_tender');
    }
}
