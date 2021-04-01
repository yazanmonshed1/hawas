<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HawasAdminSeeder extends Seeder
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
            'username' => 'hawas',
            'email' => 'admin@hawas.com'
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'username' => 'hawas',
                'name' => 'hawas',
                'email' => 'admin@hawas.com',
                'password' => Hash::make('123456789'),
                'avatar' => 'dummy/profile-img.png'
            ])->save();
            $admin->assignRole('super_user');
        }

        // Sanaa
        $admin = Admin::firstOrNew([
            'username' => 'sanaa',
            'email' => 'sanaa@hawas.com'
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'username' => 'sanaa',
                'name' => 'sanaa',
                'email' => 'sanaa@hawas.com',
                'password' => Hash::make('123456789'),
                'avatar' => 'dummy/profile-img.png'
                ])->save();
            $admin->assignRole('super_user');
        }

        // Safa
        $admin = Admin::firstOrNew([
            'username' => 'safa',
            'email' => 'safa@hawas.com'
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'username' => 'safa',
                'name' => 'Safa',
                'email' => 'safa@hawas.com',
                'password' => Hash::make('123456789'),
                'avatar' => 'dummy/profile-img.png'
                ])->save();
            $admin->assignRole('super_user');
        }

        // Eman
        $admin = Admin::firstOrNew([
            'username' => 'eman',
            'email' => 'eman@hawas.com'
        ]);

        if (!$admin->exists) {
            $admin->fill([
                'username' => 'eman',
                'name' => 'Eman',
                'email' => 'eman@hawas.com',
                'password' => Hash::make('123456789'),
                'avatar' => 'dummy/profile-img.png'
                ])->save();
            $admin->assignRole('super_user');
        }
    }
}
