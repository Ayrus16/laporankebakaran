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
            ['namaKantor' => 'Kantor Pusat', 
                'alamat' => 'Jl. Sukabumi No.17, Kacapiring, Kec. Batununggal, Kota Bandung, Jawa Barat 40271',
                'latitude' => -6.915127983658259,
                'longitude' => 107.63398931060883
            ],

            ['namaKantor' => 'Kantor Utara',
                 'alamat' => 'Jl. Sindang Sirna No.40, Gegerkalong, Kec. Sukajadi, Kota Bandung, Jawa Barat 40151',
                 'latitude' => -6.8752260226807715,
                 'longitude' => 107.59029438862407
            ],

            ['namaKantor' => 'Kantor Selatan',
                 'alamat' => 'Jl. Caringin No.103, Babakan Ciparay, Kec. Babakan Ciparay, Kota Bandung, Jawa Barat 40223',
                 'latitude' => -6.945899134287743,
                 'longitude' => 107.58275442930116
            ],

            ['namaKantor' => 'Kantor Barat',
                'alamat' => 'Jl. Tundungsari, Garuda, Kec. Andir, Kota Bandung, Jawa Barat 40184',
                'latitude' => -6.906022023064592,
                'longitude' => 107.5729498396119
            ],

            ['namaKantor' => 'Kantor Timur',
                 'alamat' => 'Cipamokolan, Rancasari, Bandung City, West Java 40292',
                 'latitude' => -6.9386401892386065,
                 'longitude' => 107.67261383301789
            ],
            
        ]);
    }
}
