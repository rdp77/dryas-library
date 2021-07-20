<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_penerbit')->insert([
            'mpn_id' => '1',
            'mpn_alamat' => 'Jl. Kalibata Tengah No. 1GH, Pasar Minggu, Jakarta Selatan',
            'mpn_name' => 'Eureka Books',
            'mpn_tlp' => '070730030',
        ]);
    }
}
