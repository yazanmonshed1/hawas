<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollapsesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collapses_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('collapse_id')->unsigned();
            $table->bigInteger('media_id')->unsigned();
            $table->enum('for', ['about_us', 'book'])->default('about_us');
            $table->timestamps();

            $table->foreign('collapse_id')->references('id')->on('collapses')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collapses_images');
    }
}
