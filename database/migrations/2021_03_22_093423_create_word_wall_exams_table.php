<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordWallExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_wall_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_content_id')->unsigned();
            $table->text('embed');
            $table->timestamps();

            $table->foreign('book_content_id')->references('id')->on('book_contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_wall_exams');
    }
}
