<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistAliasSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_alias_song', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('artist_alias_id', 26)->index();
            $table->char('user_id', 26)->index()->nullable();
            $table->char('song_id', 26)->index();

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
        Schema::dropIfExists('artist_alias_song');
    }
}
