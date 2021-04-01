<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnTypeForStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('student_exams', 'type')) {
            Schema::table('student_exams', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
        Schema::table('student_exams', function (Blueprint $table) {
            $table->enum('type', config('enums.exam_types'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
