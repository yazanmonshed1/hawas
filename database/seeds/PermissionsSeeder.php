<?php

use App\NadConsole\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = ['users', 'roles', 'permissions', 'blogs', 'collapses', 'contacts', 'digital_books', 'galleries', 'settings', 'sliders', 'text_books', 'text_book_parts', 'plays', 'schools', 'grades', 'programs', 'teachers'];
        $permission = Permission::firstOrNew(['name' => 'update settings of about us page', 'guard_name' => 'admin']);
        if (!$permission->exists) {
            $permission->fill(['name' => 'update settings of about us page', 'guard_name' => 'admin'])->save();
        }
        foreach ($tables as $tableName) {
            $permissions = [
                'edit' => 'edit ' . $tableName,
                'delete' => 'delete ' . $tableName,
                'add' => 'add ' . $tableName,
                'browse' => 'browse ' . $tableName,
            ];
            foreach ($permissions as $permissionName) {
                $data = ['name' => $permissionName, 'guard_name' => 'admin', 'table_name' => $tableName];
                $permission = Permission::firstOrNew($data);
                if (!$permission->exists) {
                    $permission->fill($data)->save();
                }
            }
        }
    }
}
