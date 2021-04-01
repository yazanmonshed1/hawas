<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoplumnChapterIdToBookContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_contents', function (Blueprint $table) {
            $table->bigInteger('chapter_id')->unsigned()->nullable();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_contents', function (Blueprint $table) {
            $table->dropForeign('book_contents_chapter_id_foreign');
            $table->dropColumn('chapter_id');
        });
    }
}
