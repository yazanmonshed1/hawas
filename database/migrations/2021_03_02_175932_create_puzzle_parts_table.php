<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzlePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puzzle_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('puzzle_id')->unsigned();
            $table->integer('x')->unsigned();
            $table->integer('y')->unsigned();
            $table->timestamps();

            $table->foreign('puzzle_id')->references('id')->on('puzzles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puzzle_parts');
    }
}
