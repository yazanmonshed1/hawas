<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('page_number');
            $table->enum('page_type', ['lesson', 'exercise'])->default('lesson');
            $table->enum('table_name', config('enums.book_content_types'));
            $table->bigInteger('book_id')->unsigned();
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('digital_books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_contents');
    }
}
