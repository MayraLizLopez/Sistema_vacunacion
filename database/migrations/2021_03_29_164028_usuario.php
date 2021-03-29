<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string ('nombre', 100);
            $table->string ('ape_pat', 100);
            $table->string ('ape_mat', 100);
            $table->unsignedBigInteger('id_insti');
            $table->string('cargo', 50);
            $table->string('rol', 50);
            $table->string('tel', 20);
            $table->string('email', 100);
            $table->boolean('activo');
            //$table->timestamps();
            $table->foreign('id_insti')->references('id_insti')->on('instituciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('usuarios');
    }
}
