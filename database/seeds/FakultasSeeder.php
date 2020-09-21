<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_fakultas')->insert([
            [
                'mf_id' => '1',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00001',
                'mf_name' => 'Ilmu Sosial dan Ilmu Politik'
            ],
            [
                'mf_id' => '2',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00002',
                'mf_name' => 'Hukum'
            ],
            [
                'mf_id' => '3',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00003',
                'mf_name' => 'Ekonomi dan Bisnis'
            ],
            [
                'mf_id' => '4',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00004',
                'mf_name' => 'Psikologi'
            ],
            [
                'mf_id' => '5',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00005',
                'mf_name' => 'Teknik'
            ],
            [
                'mf_id' => '6',
                'mf_kode' => 'FK/' . date('m') . date('y') . '/00006',
                'mf_name' => 'Ilmu Budaya'
            ],
        ]);
    }
}
