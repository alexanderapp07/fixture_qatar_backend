<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEstadisticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO tipo_estadisticas(nombre) VALUES
            ('GOL'),
            ('ASISTENCIA'),
            ('MVP'),
            ('AMARILLA'),
            ('ROJA');
        ");
    }
}
