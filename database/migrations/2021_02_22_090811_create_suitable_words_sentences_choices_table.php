<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuitableWordsSentencesChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suitable_words_sentences_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('choice');
            $table->boolean('is_correct');
            $table->bigInteger('sentence_id')->unsigned();
            $table->timestamps();

            $table->foreign('sentence_id')->references('id')->on('suitable_words_sentences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suitable_words_sentences_choices');
    }
}
