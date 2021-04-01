<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuitableWordsSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suitable_words_sentences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sentence');
            $table->bigInteger('suitable_word_id')->unsigned();
            $table->timestamps();

            $table->foreign('suitable_word_id')->references('id')->on('suitable_words')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suitable_words_sentences');
    }
}
