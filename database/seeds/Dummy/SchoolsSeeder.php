<?php

use App\Models\Admin;
use App\Models\DigitalBook;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creates a school foreach secretary
        DB::table('schools')->delete();

        $secretaries = Admin::role('secretary')->get();

        $books = DigitalBook::all();

        foreach ($secretaries as $key => $secretary) {
            $school = new School();
            $school->name = 'school ' . ($key + 1);
            $school->secretary_id = $secretary->id;
            $school->save();
            $school->books()->sync($books);
        }
    }
}
