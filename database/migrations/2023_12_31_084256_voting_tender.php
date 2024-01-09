<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VotingTender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_tender', function (Blueprint $table) {
            $table->id();
            $table->foreign('proposal_id')->references('id')->on('pengaju_proposal_tender');// foreign key ke tabel pengaju_proposals
            $table->date('tanggal_vote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_tender');
    }
}
