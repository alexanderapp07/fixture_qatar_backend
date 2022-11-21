<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfederacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO confederaciones(codigo, nombre) VALUES
            ('AFC', 'Confederación Asiática de Fútbol'),
            ('CAF', 'Confederación Africana de Fútbol'),
            ('CONCACAF', 'Confederación de Norteamérica, Centroamérica y el Caribe de Fútbol'),
            ('CONMEBOL', 'Confederación Sudamericana de Fútbol'),
            ('OFC', 'Confederación de Fútbol de Oceanía'),
            ('UEFA', 'Unión de Federaciones Europeas de Fútbol');
        ");
    }
}
