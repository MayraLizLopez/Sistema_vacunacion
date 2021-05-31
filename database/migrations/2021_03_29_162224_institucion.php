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
            $table->string ('nombre', 200);
            $table->string ('domicilio', 200);
            $table->unsignedBigInteger('id_municipio');
            $table->boolean('activo');
            $table->dateTime('fecha_creacion', $precision = 0);
            $table->dateTime('fecha_edicion', $precision = 0)->nullable();
            $table->unsignedBigInteger('id_user')->nullable();

            $table->foreign('id_municipio')->references('id_municipio')->on('municipios');
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
