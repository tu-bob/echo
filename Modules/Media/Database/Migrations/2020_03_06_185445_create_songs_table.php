<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('audio_file_id', 26)->index();
            $table->char('title', 40);
            $table->char('year', 5);
            $table->char('label', 50)->nullable();
            $table->unsignedInteger('bitrate');
            $table->unsignedInteger('sample_rate');
            $table->unsignedDouble('compression_ratio');
            $table->tinyInteger('channels');
            $table->char('channel_mode', 20);
            $table->char('encoder_options', 20);
            $table->char('codec', 20);
            $table->char('encoder', 20);
            $table->boolean('lossless');
            $table->unsignedBigInteger('size');
            $table->unsignedInteger('playtime_seconds');
            $table->char('extension', 10);
            $table->softDeletes();
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
        Schema::dropIfExists('songs');
    }
}
