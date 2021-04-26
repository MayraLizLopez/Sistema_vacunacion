<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sede extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->bigIncrements('id_sede');
            $table->unsignedBigInteger('id_municipio');
            $table->string ('nombre', 255);
            $table->string ('direccion', 255);
            $table->string ('cruce_calles', 255)->nullable();
            $table->string ('colonia', 255)->nullable();
            $table->string ('cp', 255)->nullable();
            $table->string ('georeferencia', 255)->nullable();
            $table->string ('nombre_encargado', 255)->nullable();
            $table->string ('tel_encargado', 255)->nullable();
            $table->string ('email_encargado', 255)->nullable();
            $table->integer ('cupo');
            $table->boolean('activo');
            $table->date('fecha_creacion', 255);
            $table->date('fecha_edicion', 255)->nullable();
            $table->foreign('id_municipio')->references('id_municipio')->on('municipios');
            //$table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
}
