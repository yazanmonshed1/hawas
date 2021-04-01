<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = Admin::firstOrNew([
            'username' => 'admin',
            'email' => 'admin@admin.com'
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin')
            ])->save();
            $admin->assignRole('super_user');
        }

        // Secretary
        foreach ([1, 2, 3] as $i) {
            $secretary = Admin::firstOrNew([
                'username' => 'secretary' . $i,
                'email' => 'secretary' . $i . '@secretary.com'
            ]);

            if (!$secretary->exists) {
                $secretary->fill([
                    'name' => 'secretary' . $i,
                    'username' => 'secretary' . $i,
                    'email' => 'secretary' . $i . '@secretary.com',
                    'password' => Hash::make('secretary')
                ])->save();
                $secretary->assignRole('secretary');
            }
        }
    }
}
