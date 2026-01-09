<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $kantorIds = DB::table('kantors')->pluck('id')->all();
        $reguIds   = DB::table('regus')->pluck('id')->all();

        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'idKantor' => $kantorIds[0] ?? null,
                'idRegu' => $reguIds[0] ?? null,
                'noteleponPetugas' => '081234567890',
                'isActive' => true,
            ]
        );
        $admin->syncRoles(['admin']);

        $petugas1 = User::updateOrCreate(
            ['email' => 'petugas1@example.com'],
            [
                'name' => 'Petugas 1',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'idKantor' => $kantorIds[1] ?? ($kantorIds[0] ?? null),
                'idRegu' => $reguIds[1] ?? ($reguIds[0] ?? null),
                'noteleponPetugas' => '082345678901',
                'isActive' => true,
            ]
        );
        $petugas1->syncRoles(['komandan']); // atau anggota

        $petugas2 = User::updateOrCreate(
            ['email' => 'petugas2@example.com'],
            [
                'name' => 'Petugas Nonaktif',
                'password' => Hash::make('password'),
                'email_verified_at' => null,
                'idKantor' => $kantorIds[2] ?? ($kantorIds[0] ?? null),
                'idRegu' => $reguIds[2] ?? ($reguIds[0] ?? null),
                'noteleponPetugas' => '083456789012',
                'isActive' => false,
            ]
        );
        $petugas2->syncRoles(['anggota']);
    }
}

