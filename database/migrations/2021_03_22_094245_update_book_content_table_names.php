<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateBookContentTableNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (Schema::hasColumn('book_contents', 'table_name')) {
        //     Schema::table('book_contents', function (Blueprint $table) {
        //         $table->dropColumn('table_name');
        //     });
        // }
        // Schema::table('book_contents', function (Blueprint $table) {
        //     $table->enum('table_name', config('enums.book_content_types'))->change();
        // });
        DB::statement("ALTER TABLE book_contents CHANGE table_name table_name ENUM('puzzles','painting_images','suitable_words','drawing','story','multiple_choices','videos','matching_words_to_images','matching_words_to_sentences','memory_game','wordwall_exam') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_contents', function (Blueprint $table) {
            //
        });
    }
}
