<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'nombre' => 'administrador',
            'apellido' => 'administrador',
            'nickname' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
            'rol_id' => 1
        ]);
    }
}
