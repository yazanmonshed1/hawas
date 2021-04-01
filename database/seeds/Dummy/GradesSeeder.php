<?php

use App\Models\Grade;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();

        $schools = School::all();

        foreach ($schools as $school) {
            foreach ([1, 2, 3] as $num) {
                $grade = new Grade();
                $grade->name = 'grade ' . $num;
                $grade->school_id = $school->id;
                $grade->teacher_id = $school->teachers->first()->id;
                $grade->save();
                $grade->books()->sync($school->books);
            }
        }
    }
}
