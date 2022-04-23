<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlistables', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('playlist_id', 26)->index();
            $table->char('playlistable_id', 26)->index();
            $table->string('playlistable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlistables');
    }
};
