<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShapeDrawingsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shape_drawings_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('color');
            $table->bigInteger('shape_drawing_id')->unsigned();
            $table->timestamps();

            $table->foreign('shape_drawing_id')->references('id')->on('shape_drawings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shape_drawings_colors');
    }
}
