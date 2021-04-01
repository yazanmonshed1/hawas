<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaintImagesColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paint_images_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paint_image_id')->unsigned();
            $table->string('color');
            $table->timestamps();

            $table->foreign('paint_image_id')->references('id')->on('paint_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paint_images_colors');
    }
}
