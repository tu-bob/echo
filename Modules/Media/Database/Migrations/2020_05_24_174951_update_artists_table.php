<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->text('info')->nullable();
            $table->char('type', 40)->nullable();
            $table->char('avatar_id', 26)->index()->nullable();
            $table->counters();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('info');
            $table->dropColumn('avatar_id');
            $table->dropColumn('type');
            $table->dropColumn('view_count');
            $table->dropColumn('play_count');
            $table->dropColumn('download_count');
        });
    }
}
