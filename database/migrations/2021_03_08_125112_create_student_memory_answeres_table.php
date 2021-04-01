<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMemoryAnsweresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_memory_answeres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_exam_id')->unsigned();
            $table->integer('attempts');
            $table->integer('time');
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
        Schema::dropIfExists('student_memory_answeres');
    }
}
