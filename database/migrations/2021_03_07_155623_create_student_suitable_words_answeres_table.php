<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSuitableWordsAnsweresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_suitable_words_answeres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('answer_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('student_exam_id')->unsigned();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('suitable_words_sentences')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('suitable_words_sentences_choices')->onDelete('cascade');
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
        Schema::dropIfExists('student_suitable_words_answeres');
    }
}
