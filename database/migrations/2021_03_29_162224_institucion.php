<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Institucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('instituciones', function (Blueprint $table) {
            $table->bigIncrements('id_insti');
            $table->string ('nombre', 100);
            $table->string ('domicilio', 200);
            $table->unsignedBigInteger('id_munici');
            $table->string('nombre_enlace', 100);
            $table->string('cargo_enlace', 50);
            $table->string('tel', 20);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->boolean('activo');
            //$table->timestamps();
            $table->foreign('id_munici')->references('id_municipio')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituciones');
    }
}
