<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $permissions = [
            'books.view',
            'books.create',
            'books.edit',
            'books.delete',
            'users.manage-roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $dosen = Role::firstOrCreate([
            'name' => 'Dosen',
            'guard_name' => 'web',
        ]);

        $mahasiswa = Role::firstOrCreate([
            'name' => 'Mahasiswa',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions($permissions);

        $dosen->syncPermissions([
            'books.view',
            'books.create',
            'books.edit',
        ]);

        $mahasiswa->syncPermissions([
            'books.view',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}