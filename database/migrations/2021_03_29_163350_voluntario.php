<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Voluntario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntarios', function (Blueprint $table) {
            $table->bigIncrements('id_voluntario');
            $table->string ('nombre', 100);
            $table->string ('ape_pat', 100);
            $table->string ('ape_mat', 100)->nullable();
            $table->unsignedBigInteger('id_insti');
            $table->unsignedBigInteger('id_municipio');
            $table->string('tel', 20);
            $table->string('email', 100)->unique();
            $table->boolean('activo');
            $table->boolean('eliminado');
            $table->dateTime('fecha_creacion', $precision = 0);
            $table->dateTime('fecha_edicion', $precision = 0)->nullable();
            //$table->timestamps();
            $table->foreign('id_insti')->references('id_insti')->on('instituciones');
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
        Schema::dropIfExists('voluntarios');
    }
}
