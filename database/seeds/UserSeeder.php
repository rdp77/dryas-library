<?php

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
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'registration_kode' => Str::random(10),
                'address' => Str::random(10),
                'tlp' => '+621234567890',
                'password' => Hash::make(123123123),
                'previleges' => '1',
                'kode' => app('App\Http\Controllers\userController')->kodeadm(),
                'address_univ' => 'Jl. Semolowaru No.45',
                'photo' => 'default.svg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime("+4 years")),
                'username' => 'adm',
            ],
            [
                'id' => '2',
                'name' => 'User',
                'email' => 'user@user.com',
                'registration_kode' => Str::random(10),
                'address' => Str::random(10),
                'tlp' => '+621234567890',
                'password' => Hash::make(12345678),
                'previleges' => '3',
                'kode' => app('App\Http\Controllers\userController')->kodemhs(),
                'address_univ' => 'Jl. Semolowaru No.45',
                'photo' => 'default.svg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime("+4 years")),
                'username' => 'mhs',
                // 'fakultas' => 'default.svg',
                // 'jurusan' => 'default.svg',
            ]
        ]);
    }
}
