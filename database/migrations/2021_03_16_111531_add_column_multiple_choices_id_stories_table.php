<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMultipleChoicesIdStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->bigInteger('multiple_choices_id')->unsigned()->nullable()->default(null);
            $table->foreign('multiple_choices_id')->references('id')->on('book_contents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign('stories_multiple_choices_id_foreign');
            $table->dropColumn('multiple_choices_id');
        });
    }
}
