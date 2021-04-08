<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	DB::table('instituciones')->insert([
            'nombre' => 'Auditorio Benito Juárez',
            'domicilio' => 'Av. Mariano Barcena s/n, Auditorio, 45190.',
            'id_municipio' => 119,
            'tel' => '48454654654',
            'nombre_enlace' => 'Juan Perez',
            'cargo_enlace' => 'director',
            'email' => 'juanperez@gmail.com',
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('instituciones')->insert([
            'nombre' => 'Auditorio Telmex',
            'domicilio' => 'Av. Obreros de Cananea 746, Industrial los Belenes, 45150',
            'tel' => '486848468',
            'nombre_enlace' => 'Mario López',
            'cargo_enlace' => 'director',
            'email' => 'mario@gmail.com',
            'activo' => true,
            'id_municipio' => 119,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('instituciones')->insert([
            'nombre' => 'Centro Universitario de Ciencias Exactas e Ingenierías',
            'domicilio' => 'Blvd. Gral. Marcelino García Barragán 1421, Olímpica, 44430',
            'tel' => '4868687687',
            'nombre_enlace' => 'Martha Murrieta Gonzalez',
            'cargo_enlace' => 'director',
            'email' => 'miguel2@gmail.com',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
        ]);

    }
}
