<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPuzzleAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_puzzle_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_exam_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('student_puzzle_answers');
    }
}
