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
            $table->unsignedBigInteger('id_sede')->nullable();
            $table->uuid('uuid');
            $table->integer('horas');
            $table->boolean('activo')->nullable();
            $table->boolean('eliminado');
            $table->foreign('id_jornada')->references('id_jornada')->on('jornadas');
            $table->foreign('id_voluntario')->references('id_voluntario')->on('voluntarios');
            //$table->foreign('id_sede')->references('id_sede')->on('sedes');
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
