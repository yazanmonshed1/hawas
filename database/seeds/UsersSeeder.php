<?php

use App\Models\Grade;
use App\Models\User;
use App\NadConsole\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $grades = Grade::all();

        foreach ($grades as $grade) {
            $user = new User();
            $user->name = 'student' . ' ' . $grade->school->name . ' ' . $grade->name;
            $user->username = 'student' . '_' . str_replace(' ', '_', $grade->school->name) . '_' . str_replace(' ', '_', $grade->name);
            $user->email = 'student' .  '_' . $grade->school->id . '_' . $grade->id . '@hawas.com';
            $user->id_no = time();
            $user->phone_no = '078' . time();
            $user->avatar = 'dummy/profile-img.png';
            $user->password = Hash::make('12345678');
            $user->grade_id = $grade->id;
            $user->save();

            $studentRole = Role::where(['name' => 'student'])->first();

            $user->roles()->attach($studentRole);
        }
    }
}
