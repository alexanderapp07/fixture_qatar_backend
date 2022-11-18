<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->id();

            // Relación con tabla tipos_estadisticas
            $table->bigInteger('tipo_estadistica_id')->unsigned();
            $table->foreign('tipo_estadistica_id')->references('id')->on('tipo_estadisticas')->onDelete('restrict');

            // Relación con tabla Partido
            $table->bigInteger('partido_id')->unsigned();
            $table->foreign('partido_id')->references('id')->on('partidos')->onDelete('restrict');

            // Relación con tabla Jugador
            $table->bigInteger('jugador_id')->unsigned();
            $table->foreign('jugador_id')->references('id')->on('jugadores')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadisticas');
    }
};
