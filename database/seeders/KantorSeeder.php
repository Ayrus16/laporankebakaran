<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kantors')->insert([
            ['namaKantor' => 'Kantor Pusat', 'alamat' => 'Jl. Sukabumi No.17, Kacapiring, Kec. Batununggal, Kota Bandung, Jawa Barat 40271'],
            ['namaKantor' => 'Kantor Utara', 'alamat' => 'Jl. Sindang Sirna No.40, Gegerkalong, Kec. Sukajadi, Kota Bandung, Jawa Barat 40151'],
            ['namaKantor' => 'Kantor Selatan', 'alamat' => 'Jl. Caringin No.103, Babakan Ciparay, Kec. Babakan Ciparay, Kota Bandung, Jawa Barat 40223'],
            ['namaKantor' => 'Kantor Barat', 'alamat' => 'Jl. Tundungsari, Garuda, Kec. Andir, Kota Bandung, Jawa Barat 40184'],
            ['namaKantor' => 'Kantor Timur', 'alamat' => 'Cipamokolan, Rancasari, Bandung City, West Java 40292'],
        ]);
    }
}
