<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistAliasMusicAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_alias_music_album', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('music_album_id', 26)->index();
            $table->char('artist_alias_id', 26)->index();
            $table->integer('artist_songs_count');

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
        Schema::dropIfExists('album_artist_alias');
    }
}
