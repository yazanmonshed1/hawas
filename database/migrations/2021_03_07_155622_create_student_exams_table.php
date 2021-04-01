<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', config('enums.exam_types'));
            $table->enum('status', config('enums.exam_statuses'))->default('initial');
            $table->bigInteger('book_content_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('mark')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();

            $table->foreign('book_content_id')->references('id')->on('book_contents')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_exams');
    }
}
