<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_kategori')->insert(
            [
                'mk_id' => '1',
                'mk_name' => 'Horror',
            ],
            [
                'mk_id' => '2',
                'mk_name' => 'Fantasy',
            ],
            [
                'mk_id' => '3',
                'mk_name' => 'Peta',
            ],
            [
                'mk_id' => '4',
                'mk_name' => 'Langka',
            ],
            [
                'mk_id' => '5',
                'mk_name' => 'Biografi',
            ],
            [
                'mk_id' => '6',
                'mk_name' => 'Karya Ilmiah',
            ],
            [
                'mk_id' => '7',
                'mk_name' => 'Agama',
            ],
            [
                'mk_id' => '8',
                'mk_name' => 'Ekonomi',
            ],
            [
                'mk_id' => '9',
                'mk_name' => 'Teknlogi dan Informasi',
            ]
        );
    }
}
