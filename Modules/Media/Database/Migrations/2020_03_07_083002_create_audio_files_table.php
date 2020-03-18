<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_files', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->string('path');
            $table->string('filename');
            $table->string('mime_type');
            $table->char('extension', 10);
            $table->string('hash');

            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_files');
    }
}
