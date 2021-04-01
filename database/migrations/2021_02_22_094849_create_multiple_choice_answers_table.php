<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('choice');
            $table->bigInteger('multiple_choice_id')->unsigned();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->foreign('multiple_choice_id')->references('id')->on('multiple_choices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_choice_answers');
    }
}
