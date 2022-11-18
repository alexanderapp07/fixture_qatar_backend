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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha'); // cambiar en BD este campo para utilizarlo como string (dd/mm/yyyy)
            $table->string('hora'); // 1cambiar en BD este campo para utilizarlo como string (HH:mm)

            // Relación con tabla paises
            $table->bigInteger('local_pais_id')->unsigned();
            $table->foreign('local_pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->bigInteger('visita_pais_id')->unsigned();
            $table->foreign('visita_pais_id')->references('id')->on('paises')->onDelete('restrict');

            // Relación con tabla estadios
            $table->bigInteger('estadio_id')->unsigned();
            $table->foreign('estadio_id')->references('id')->on('estadios')->onDelete('restrict');

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
        Schema::dropIfExists('partidos');
    }
};
