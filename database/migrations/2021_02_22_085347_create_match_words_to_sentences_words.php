<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchWordsToSentencesWords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_words_to_sentences_words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word');
            $table->string('sentence');
            $table->bigInteger('match_word_to_sentence_id')->unsigned();
            $table->timestamps();

            $table->foreign('match_word_to_sentence_id')->references('id')->on('match_word_to_sentences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_words_to_sentences_words');
    }
}
