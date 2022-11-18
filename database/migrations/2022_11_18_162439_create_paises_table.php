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
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->string('coi', 25);
            $table->string('grupo', 25);

            // Relación con tabla confederaciones
            $table->bigInteger('confederacion_id')->unsigned();
            $table->foreign('confederacion_id')->references('id')->on('confederaciones')->onDelete('restrict');
            
            // Relación con tabla entrenadores
            $table->bigInteger('entrenador_id')->unsigned();
            $table->foreign('entrenador_id')->references('id')->on('entrenadores')->onDelete('restrict');

            
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
        Schema::dropIfExists('pais');
    }
};
