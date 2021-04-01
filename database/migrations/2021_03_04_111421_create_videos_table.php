<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('video');
            $table->bigInteger('book_content_id')->unsigned();
            $table->bigInteger('multiple_choices_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('book_content_id')->references('id')->on('book_contents')->onDelete('cascade');
            $table->foreign('multiple_choices_id')->references('id')->on('book_contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
