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
            $table->string ('nombre', 255);
            $table->string ('direccion', 255);
            $table->integer ('cupo');
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
        Schema::dropIfExists('sedes');
    }
}
