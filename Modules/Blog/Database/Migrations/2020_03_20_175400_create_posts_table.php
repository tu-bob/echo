<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('author_id', 26)->index();
            $table->char('preview_image_id', 26)->index()->nullable();
            $table->string('title');
            $table->string('annotation', 300);
            $table->text('article');
            $table->string('reference', 255);
            $table->string('ref_name', 255);

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
        Schema::dropIfExists('posts');
    }
}
