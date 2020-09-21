<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_pengarang')->insert([
            'mpg_id' => '1',
            'mpg_alamat' => '5454 I 55 N, Jackson, Mississippi 39211',
            'mpg_name' => 'J.K. Rowling',
            'mpg_tlp' => '07073000',
        ]);
    }
}
