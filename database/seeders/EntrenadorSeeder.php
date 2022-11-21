<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO entrenadores(nombre, apellido, nacionalidad, edad) VALUES
            ('Félix ', 'Sánchez ', 'Español', 47),
            ('Gustavo ', 'Alfaro', 'Argentino', 60),
            ('Aliou', ' Cissé', 'Senegales', 47),
            ('Louis', 'van Gaal', 'Neerlandés ', 71),
            ('Gareth', 'Southgate', 'Inglés ', 52),
            ('Carlos ', 'Queiroz', 'Mozambique', 69),
            ('Gregg', 'Berhalter', 'Estadounidense', 49),
            ('Rob ', 'Page', 'Galés ', 48),
            ('Lionel ', 'Scaloni', 'Argentino', 44),
            ('Hervé ', 'Renard', 'Francés ', 54),
            ('Gerardo', 'Martino', 'Argentino', 60),
            ('Czeslaw', 'Michniewicz', 'Bielorruso', 52),
            ('Didier', 'Deschamps', 'Francés ', 54),
            ('Graham', 'Arnold', 'Australiano', 59),
            ('Kasper', 'Hjulmand', 'Danés ', 50),
            ('Jalel ', 'Kadri', 'Tunecino', 50),
            ('Luís Enrique', 'Martínez ', 'Español', 52),
            ('Luis', 'Suárez ', 'Colombiano', 62),
            ('Hansi', 'Flick', 'Alemán ', 57),
            ('Hajime', 'Moriyasu', 'Japones', 54),
            ('Roberto', 'Martínez ', 'Español', 49),
            ('John', 'Herdman', 'Inglés ', 47),
            ('Walid', 'Regragui', 'Francés ', 47),
            ('Zlatko ', 'Dalic', 'Bosnio', 56),
            ('Adenor', 'Bacchi', 'Brasileño', 61),
            ('Dragan', 'Stojkovic', 'Serbio', 57),
            ('Murat', 'Yakin', 'Suizo', 48),
            ('Rigobert', 'Song', 'Camerunes', 46),
            ('Roberto', 'Santos', 'Portugués ', 68),
            ('Diego ', 'Alonso', 'Uruguayo ', 47),
            ('Paulo ', 'Bento', 'Portugués ', 53),
            ('Otto', 'Addo', 'Alemán ', 47);        
        ");
    }
}
