<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Confederacion;
use App\Models\TipoEstadistica;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call([
            ConfederacionSeeder::class,
            EntrenadorSeeder::class,
            EstadioSeeder::class,
            PaisSeeder::class,
            JugadorSeeder::class,
            RolSeeder::class,
            UserSeeder::class,
            PerfilSeeder::class,
            PartidoSeeder::class,
            EstadisticaSeeder::class
        ]);
    }
}
