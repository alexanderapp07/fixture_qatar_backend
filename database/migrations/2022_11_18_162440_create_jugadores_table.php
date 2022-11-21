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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->string('apellido', 25);
            $table->string('posicion', 25);
            $table->integer('edad');
            $table->string('club', 100);

            // Relación con tabla paises
            $table->bigInteger('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('restrict');

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
        Schema::dropIfExists('jugadors');
    }
};
