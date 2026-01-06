<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regus')->insert([
            ['namaRegu' => 'Regu A'],
            ['namaRegu' => 'Regu B'],
            ['namaRegu' => 'Regu C'],
        ]);
    }
}
