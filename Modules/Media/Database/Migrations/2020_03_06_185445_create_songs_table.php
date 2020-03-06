<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->char('title', 40);
            $table->char('year', 5);
            $table->char('label', 50)->nullable();
            $table->unsignedInteger('bitrate');
            $table->unsignedInteger('sample_rate');
            $table->unsignedSmallInteger('length');
            $table->char('container', 20);
            $table->char('extension', 10);
            $table->char('codec', 20);
            $table->boolean('lossless');
            $table->boolean('size');
            $table->string('file_path');
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
