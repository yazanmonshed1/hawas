<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMediaTypeToDigitalBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('digital_books', 'cover_image')) {
            Schema::table('digital_books', function (Blueprint $table) {
                $table->string('cover_image');
            });
        }
        Schema::table('digital_books', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digital_books', function (Blueprint $table) {
            $table->dropColumn('media_type');
        });
    }
}
