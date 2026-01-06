<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil id referensi (asumsi seed kantor/regu/jabatan sudah jalan duluan)
        $kantorIds  = DB::table('kantors')->pluck('id')->all();
        $jabatanIds = DB::table('jabatans')->pluck('id')->all();
        $reguIds    = DB::table('regus')->pluck('id')->all();

        $now = now();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => $now,
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,

                'idKantor' => $kantorIds[0] ?? null,
                'idJabatan' => $jabatanIds[0] ?? null,
                'idRegu' => $reguIds[0] ?? null,
                'noteleponPetugas' => '081234567890',
                'isActive' => true,
            ],
            [
                'name' => 'Petugas 1',
                'email' => 'petugas1@example.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,

                'idKantor' => $kantorIds[1] ?? ($kantorIds[0] ?? null),
                'idJabatan' => $jabatanIds[2] ?? null, // Petugas
                'idRegu' => $reguIds[1] ?? ($reguIds[0] ?? null),
                'noteleponPetugas' => '082345678901',
                'isActive' => true,
            ],
            [
                'name' => 'Petugas Nonaktif',
                'email' => 'petugas2@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,

                'idKantor' => $kantorIds[2] ?? ($kantorIds[0] ?? null),
                'idJabatan' => $jabatanIds[2] ?? null,
                'idRegu' => $reguIds[2] ?? ($reguIds[0] ?? null),
                'noteleponPetugas' => '083456789012',
                'isActive' => false,
            ],
        ]);
    }
}
