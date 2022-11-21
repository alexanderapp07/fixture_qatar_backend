<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO paises(nombre, coi, grupo, entrenador_id, confederacion_id) VALUES
            ('Qatar', 'QAT', 'A', 1, '1'),
            ('Ecuador', 'ECU', 'A', 2, '4'),
            ('Senegal', 'SEN', 'A', 3, '2'),
            ('Países Bajos', 'HOL', 'A', 4, '6'),
            ('Inglaterra', 'ENG', 'B', 5, '6'),
            ('Irán', 'IRN', 'B', 6, '1'),
            ('Estados Unidos', 'USA', 'B', 7, '3'),
            ('Gales', 'WAL', 'B', 8, '6'),
            ('Argentina', 'ARG', 'C', 9, '4'),
            ('Arabia Saudita', 'KSA', 'C', 10, '1'),
            ('México', 'MEX', 'C', 11, '3'),
            ('Polonia', 'POL', 'C', 12, '6'),
            ('Francia', 'FRA', 'D', 13, '6'),
            ('Australia', 'AUS', 'D', 14, '1'),
            ('Dinamarca', 'DEN', 'D', 15, '6'),
            ('Túnez', 'TUN', 'D', 16, '2'),
            ('España', 'ESP', 'E', 17, '6'),
            ('Costa Rica', 'CRC', 'E', 18, '3'),
            ('Alemania', 'GER', 'E', 19, '6'),
            ('Japón', 'JPN', 'E', 20, '1'),
            ('Bélgica', 'BEL', 'F', 21, '6'),
            ('Canadá', 'CAN', 'F', 22, '3'),
            ('Marruecos', 'MAR', 'F', 23, '2'),
            ('Croacia', 'CRO', 'F', 24, '6'),
            ('Brasil', 'BRA', 'G', 25, '4'),
            ('Serbia', 'SRB', 'G', 26, '6'),
            ('Suiza', 'SUI', 'G', 27, '6'),
            ('Camerún', 'CMR', 'G', 28, '2'),
            ('Portugal', 'POR', 'H', 29, '6'),
            ('Uruguay', 'URU', 'H', 30, '4'),
            ('Corea del Sur', 'KOR', 'H', 31, '1'),
            ('Ghana', 'GHA', 'H', 32, '2');
        ");
    }
}
