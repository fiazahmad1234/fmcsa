<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;   // ✅ THIS LINE WAS MISSING
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles & permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user  = Role::firstOrCreate(['name' => 'user']);
        $guest  = Role::firstOrCreate(['name' => 'guest']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo('view users');
        $guest->givePermissionTo('delete users');
        $editor->givePermissionTo('edit users');


    }
}
