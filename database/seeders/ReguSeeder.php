<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReguSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil mapping id kantor berdasarkan namaKantor
        $kantorIds = DB::table('kantors')
            ->whereIn('namaKantor', ['Kantor Pusat', 'Kantor Utara', 'Kantor Selatan', 'Kantor Barat', 'Kantor Timur'])
            ->pluck('id', 'namaKantor'); // ['Kantor Pusat' => 1, ...]

        DB::table('regus')->insert([
            [
                'namaRegu'  => 'Regu A',
                'idKantor'  => $kantorIds['Kantor Pusat'] ?? null,
            ],
            [
                'namaRegu'  => 'Regu B',
                'idKantor'  => $kantorIds['Kantor Utara'] ?? null,
            ],
            [
                'namaRegu'  => 'Regu C',
                'idKantor'  => $kantorIds['Kantor Selatan'] ?? null,
            ],
        ]);
    }
}
