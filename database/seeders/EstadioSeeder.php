<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO estadios(nombre, capacidad) VALUES
            ('Al Bayt Stadium', '60,000.00'),
            ('Khalifa International Stadium', '40,000.00'),
            ('Al Thumama Stadium', '40,000.00'),
            ('Ahmad Bin Ali Stadium', '40,000.00'),
            ('Lusail Stadium', '80,000.00'),
            ('Stadium 974', '40,000.00'),
            ('Education City Stadium', '40,000.00'),
            ('Al Janoub Stadium', '40,000.00');

        ");
    }
}
