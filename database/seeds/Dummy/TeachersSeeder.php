<?php

use App\Models\Admin;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::whereHas("roles", function ($q) {
            $q->where("name", "teacher");
        })->delete();

        $schools = School::all()->pluck('id');

        // Teacher foreach school
        foreach ($schools as $school_id) {
            $teacher = new Teacher();
            $teacher->username = 'kakashi' . $school_id;
            $teacher->name = 'kakashi' . $school_id;
            $teacher->email = 'teacher@admin.com' . $school_id;
            $teacher->phone_no = '123' . $school_id;
            $teacher->id_no = '123' . $school_id;
            $teacher->password = Hash::make('12345678');
            $teacher->school_id = $school_id;
            $teacher->save();
            $teacher->assignRole('teacher');
        }
    }
}
