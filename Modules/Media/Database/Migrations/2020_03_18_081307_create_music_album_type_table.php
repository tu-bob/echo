<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicAlbumTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_album_types', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('name', 255)->unique();
            $table->char('local_name', 255)->nullable()->unique();

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
        Schema::dropIfExists('music_album_types');
    }
}
