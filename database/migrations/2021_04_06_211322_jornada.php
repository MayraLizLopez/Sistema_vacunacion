<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jornada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornadas', function (Blueprint $table) {
            $table->bigIncrements('id_jornada');
            $table->date ('fecha_inicio', 255);
            $table->date ('fecha_fin', 255);
            $table->string ('mensaje', 500);
            $table->boolean('activo');
            $table->date('fecha_creacion', 255);
            $table->date('fecha_edicion', 255)->nullable();
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
        Schema::dropIfExists('jornadas');
    }
}
