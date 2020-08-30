<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagables', function (Blueprint $table) {
            $table->char('id', 26)->primary();

            $table->string('image_id')->index();
            $table->string('imagable_id')->index();
            $table->string('imagable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagables');
    }
}
