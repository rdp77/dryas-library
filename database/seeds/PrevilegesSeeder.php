<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrevilegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_previleges')->insert([
            [
                'mp_id' => '1',
                'mp_name' => 'Staff Perpustakaan'
            ],
            [
                'mp_id' => '2',
                'mp_name' => 'Dosen'
            ],
            [
                'mp_id' => '3',
                'mp_name' => 'Mahasiswa'
            ]
        ]);
    }
}
