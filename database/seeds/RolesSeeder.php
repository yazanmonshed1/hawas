<?php

use App\NadConsole\Models\Permission;
use App\NadConsole\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin / Editor
        $adminRole = Role::firstOrNew(['name' => 'super_user', 'guard_name' => 'admin']);
        if (!$adminRole->exists) {
            $adminRole->fill(['name' => 'super_user', 'guard_name' => 'admin'])->save();
            $permissions = Permission::all()->pluck('id')->toArray();
            $adminRole->syncPermissions($permissions);
        }
        $editorRole = Role::firstOrNew(['name' => 'editor', 'guard_name' => 'admin']);
        if (!$editorRole->exists) {
            $editorRole->fill(['name' => 'editor', 'guard_name' => 'admin'])->save();
        }

        $secretaryRole = Role::firstOrNew(['name' => 'secretary', 'guard_name' => 'admin']);
        if (!$secretaryRole->exists) {
            $secretaryRole->fill(['name' => 'secretary', 'guard_name' => 'admin'])->save();
            $permissions = Permission::whereIn('table_name', ['users', 'schools', 'grades', 'teachers'])->pluck('id')->toArray();
            $secretaryRole->syncPermissions($permissions);
        }

        // Student
        $roleData = ['name' => 'student', 'guard_name' => 'web'];
        $role = Role::firstOrNew($roleData);
        if (!$role->exists) {
            $role->fill($roleData)->save();
        }
        // Teacher
        $roleData = ['name' => 'teacher', 'guard_name' => 'admin'];
        $role = Role::firstOrNew($roleData);
        if (!$role->exists) {
            $role->fill($roleData)->save();
        }
    }
}
