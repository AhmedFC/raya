<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $groups = array_keys(config()->get('permission_groups.groups'));
        $permissions = [];
        foreach ($groups as $group) {
            foreach (config()->get('permission_groups.groups.' . $group) as $index => $model) {
                foreach (config()->get('permission_groups.groups.' . $group . '.' . $index) as $map) {
                    $permissions[] = $map . '_' . $index;
                }
            }
        }

        Permission::truncate();
        Role::truncate();
        $admin_role = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin_role->givePermissionTo($permission);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
