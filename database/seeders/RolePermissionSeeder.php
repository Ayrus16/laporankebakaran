<?php

// database/seeders/RolePermissionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $perms = [
            'kejadian.viewAny',
            'kejadian.view',
            'kejadian.create',
            'kejadian.update',
            'kejadian.delete',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $komandan = Role::firstOrCreate(['name' => 'komandan']);
        $anggota = Role::firstOrCreate(['name' => 'anggota']);

        // Admin boleh semua (pilih salah satu pendekatan):
        $admin->syncPermissions(Permission::all());

        // Komandan & anggota: contoh umum
        $komandan->syncPermissions([
            'kejadian.viewAny','kejadian.view','kejadian.create','kejadian.update',
        ]);

        $anggota->syncPermissions([
            'kejadian.viewAny','kejadian.view',
        ]);
    }
}
