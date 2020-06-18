<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaybacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playbacks', function (Blueprint $table) {
            $table->commonFields();
            $table->string('ip')->nullable();
            $table->string('device')->nullable();
            $table->string('playable_id');
            $table->string('playable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playbacks');
    }
}
