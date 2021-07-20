<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'I\'m Admin',
                'username' => 'admin',
                'registration_kode' => Str::random(10),
                'address' => Str::random(10),
                'tlp' => '01234567890',
                'password' => Hash::make(123123123),
                'previleges' => '1',
                'kode' => app('App\Http\Controllers\userController')->kodeadm(),
                'address_univ' => 'Jl. Semolowaru No.45',
                'photo' => 'default.svg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime("+4 years")),
                'fakultas' => '0',
                'jurusan' => '0',
            ],
            [
                'id' => '2',
                'name' => 'I\'m User',
                'username' => 'user',
                'registration_kode' => Str::random(10),
                'address' => Str::random(10),
                'tlp' => '01234567890',
                'password' => Hash::make(12345678),
                'previleges' => '3',
                'kode' => app('App\Http\Controllers\userController')->kodemhs(),
                'address_univ' => 'Jl. Semolowaru No.45',
                'photo' => 'default.svg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime("+4 years")),
                'fakultas' => '5',
                'jurusan' => '9',
            ]
        ]);
    }
}
