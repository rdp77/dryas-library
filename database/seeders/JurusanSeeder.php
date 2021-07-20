<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_jurusan')->insert([
            [
                'mj_id' => '1',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00001',
                'mj_name' => 'Ilmu Komunikasi',
                'mj_fakultas' => '1'
            ],
            [
                'mj_id' => '2',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00002',
                'mj_name' => 'Administrasi Bisnis',
                'mj_fakultas' => '1'
            ],
            [
                'mj_id' => '3',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00003',
                'mj_name' => 'Administrasi Publik',
                'mj_fakultas' => '1'
            ],
            [
                'mj_id' => '4',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00004',
                'mj_name' => 'Ilmu Hukum',
                'mj_fakultas' => '2'
            ],
            [
                'mj_id' => '5',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00005',
                'mj_name' => 'Manajemen',
                'mj_fakultas' => '3'
            ],
            [
                'mj_id' => '6',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00006',
                'mj_name' => 'Pembangunan',
                'mj_fakultas' => '3'
            ],
            [
                'mj_id' => '7',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00007',
                'mj_name' => 'Akutansi',
                'mj_fakultas' => '3'
            ],
            [
                'mj_id' => '8',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00008',
                'mj_name' => 'Psikologi',
                'mj_fakultas' => '4'
            ],
            [
                'mj_id' => '9',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00009',
                'mj_name' => 'Informatika',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '10',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00010',
                'mj_name' => 'Industri',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '11',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00011',
                'mj_name' => 'Mesin',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '12',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00012',
                'mj_name' => 'Sipil',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '13',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00013',
                'mj_name' => 'Elektro',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '14',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00014',
                'mj_name' => 'Arsitektur',
                'mj_fakultas' => '5'
            ],
            [
                'mj_id' => '15',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00015',
                'mj_name' => 'Sastra Inggris',
                'mj_fakultas' => '6'
            ],
            [
                'mj_id' => '16',
                'mj_kode' => 'JS/' . date('m') . date('y') . '/00016',
                'mj_name' => 'Sastra Jepang',
                'mj_fakultas' => '6'
            ],
        ]);
    }
}
