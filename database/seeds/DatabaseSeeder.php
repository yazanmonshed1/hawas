<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DigitalBooksSeeder::class);
        $this->call(SchoolsSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(GradesSeeder::class);
        $this->call(BlogsSeeder::class);
        $this->call(GalleriesSeeder::class);
        $this->call(CollapsesSeeder::class);
        $this->call(TextBooksSeeder::class);
        $this->call(SlidersSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(ProgramsSeeder::class);
        $this->call(PlaysSeeder::class);
    }
}
