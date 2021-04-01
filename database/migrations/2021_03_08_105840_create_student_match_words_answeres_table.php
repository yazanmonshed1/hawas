<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMatchWordsAnsweresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_match_words_answeres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('answer_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('student_exam_id')->unsigned();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('match_words_to_sentences_words')->onDelete('cascade');
            $table->foreign('student_exam_id')->references('id')->on('student_exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_match_words_answeres');
    }
}
