<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartidoSeeder extends Seeder
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
            INSERT INTO partidos(fecha, hora, local_pais_id, visita_pais_id, estadio_id) VALUES
            ('2022/11/20', '10:00', 1, 2, 1),
            ('2022/11/21', '07:00', 5, 6, 2),
            ('2022/11/21', '10:00', 3, 4, 3),
            ('2022/11/21', '13:00', 7, 8, 4),
            ('2022/11/22', '04:00', 9, 10, 5),
            ('2022/11/22', '07:00', 15, 16, 7),
            ('2022/11/22', '10:00', 11, 12, 6),
            ('2022/11/22', '13:00', 13, 14, 8),
            ('2022/11/23', '04:00', 23, 24, 1),
            ('2022/11/23', '07:00', 19, 20, 2),
            ('2022/11/23', '10:00', 17, 18, 3),
            ('2022/11/23', '13:00', 21, 22, 4),
            ('2022/11/24', '04:00', 27, 28, 8),
            ('2022/11/24', '07:00', 30, 31, 7),
            ('2022/11/24', '10:00', 29, 32, 6),
            ('2022/11/24', '13:00', 25, 26, 5),
            ('2022/11/25', '04:00', 8, 6, 4),
            ('2022/11/25', '07:00', 1, 3, 3),
            ('2022/11/25', '10:00', 4, 3, 2),
            ('2022/11/25', '13:00', 5, 7, 1),
            ('2022/11/26', '04:00', 16, 14, 8),
            ('2022/11/26', '07:00', 12, 10, 7),
            ('2022/11/26', '10:00', 13, 15, 6),
            ('2022/11/26', '13:00', 9, 11, 5),
            ('2022/11/27', '04:00', 20, 18, 4),
            ('2022/11/27', '07:00', 21, 23, 3),
            ('2022/11/27', '10:00', 24, 22, 2),
            ('2022/11/27', '13:00', 17, 19, 1),
            ('2022/11/28', '04:00', 28, 26, 8),
            ('2022/11/28', '07:00', 31, 32, 7),
            ('2022/11/28', '10:00', 25, 27, 6),
            ('2022/11/28', '13:00', 29, 30, 5),
            ('2022/11/29', '09:00', 4, 1, 1),
            ('2022/11/29', '09:00', 2, 3, 2),
            ('2022/11/29', '13:00', 6, 7, 3),
            ('2022/11/29', '13:00', 8, 5, 4),
            ('2022/11/30', '09:00', 16, 13, 7),
            ('2022/11/30', '09:00', 14, 15, 8),
            ('2022/11/30', '13:00', 12, 9, 6),
            ('2022/11/30', '13:00', 10, 11, 5),
            ('2022/12/01', '09:00', 24, 21, 4),
            ('2022/12/01', '09:00', 22, 23, 3),
            ('2022/12/01', '13:00', 20, 17, 2),
            ('2022/12/01', '13:00', 18, 19, 1),
            ('2022/12/02', '09:00', 31, 29, 7),
            ('2022/12/02', '09:00', 32, 30, 8),
            ('2022/12/02', '13:00', 26, 27, 6),
            ('2022/12/02', '13:00', 28, 25, 5),
            ('2022/12/03', '09:00', 4, 7, 2),
            ('2022/12/03', '13:00', 9, 14, 4),
            ('2022/12/04', '09:00', 13, 12, 3),
            ('2022/12/04', '13:00', 5, 3, 1),
            ('2022/12/05', '09:00', 20, 24, 8),
            ('2022/12/05', '13:00', 25, 31, 6),
            ('2022/12/06', '09:00', 23, 17, 7),
            ('2022/12/06', '13:00', 29, 27, 5);
        ");
    }
}
