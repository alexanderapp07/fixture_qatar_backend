<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadisticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert("
            INSERT INTO estadisticas(nombre, partido_id, jugador_id) VALUES
            ('GOL', 1, 52),
            ('ASISTENCIA', 1, 31),
            ('GOL', 1, 52),
            ('ASISTENCIA', 2, 113),
            ('GOL', 2, 121),
            ('ASISTENCIA', 2, 110),
            ('GOL', 2, 128),
            ('ASISTENCIA', 2, 126),
            ('GOL', 2, 127),
            ('ASISTENCIA', 2, 127),
            ('GOL', 2, 128),
            ('ASISTENCIA', 2, 151),
            ('GOL', 2, 154),
            ('ASISTENCIA', 2, 126),
            ('GOL', 2, 130),
            ('ASISTENCIA', 2, 129),
            ('GOL', 2, 124),
            ('ASISTENCIA', 3, 92),
            ('GOL', 3, 95),
            ('GOL', 3, 93),
            ('ASISTENCIA', 4, 177),
            ('GOL', 4, 180),
            ('GOL', 4, 203),
            ('GOL', 5, 232),
            ('GOL', 5, 258),
            ('GOL', 5, 245),
            ('ASISTENCIA', 8, 358),
            ('GOL', 8, 349),
            ('ASISTENCIA', 8, 317),
            ('GOL', 8, 327),
            ('ASISTENCIA', 8, 327),
            ('GOL', 8, 335),
            ('ASISTENCIA', 8, 334),
            ('GOL', 8, 331),
            ('ASISTENCIA', 8, 331),
            ('GOL', 8, 335),
            ('GOL', 10, 484),
            ('GOL', 10, 508),
            ('ASISTENCIA', 10, 502),
            ('GOL', 10, 517),
            ('GOL', 11, 440),
            ('ASISTENCIA', 11, 419),
            ('GOL', 11, 438),
            ('GOL', 11, 437),
            ('GOL', 11, 437),
            ('ASISTENCIA', 11, 439),
            ('GOL', 11, 428),
            ('GOL', 11, 433),
            ('ASISTENCIA', 11, 440),
            ('GOL', 11, 439),
            ('ASISTENCIA', 12, 523),
            ('GOL', 12, 541);
        ");
    }
}
