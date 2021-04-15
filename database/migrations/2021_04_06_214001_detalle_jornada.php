<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DetalleJornada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_jornadas', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_jornada');
            $table->unsignedBigInteger('id_jornada');
            $table->unsignedBigInteger('id_voluntario');
            $table->uuid('uuid');
            $table->boolean('activo')->nullable();
            $table->boolean('eliminado');
            $table->foreign('id_jornada')->references('id_jornada')->on('jornadas');
            $table->foreign('id_voluntario')->references('id_voluntario')->on('voluntarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_jornadas');
    }
}
