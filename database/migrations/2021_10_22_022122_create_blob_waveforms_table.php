<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlobWaveformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blob_waveforms', function (Blueprint $table) {
            $table->id();
            $table->longText('blob_data')->nullable();
            $table->text('blob_type')->nullable();
            $table->text('blob_ext')->nullable();
            $table->text('blob_raw_extention')->nullable();
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
        Schema::dropIfExists('blob_waveforms');
    }
}
