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
            'id_municipio' => 1,
            'tel' => Str::random(9),
            'nombre_enlace' => 'Juan Perez',
            'cargo_enlace' => 'director',
            'email' => Str::random(10).'@gmail.com',
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('instituciones')->insert([
            'nombre' => 'Auditorio Telmex',
            'domicilio' => 'Av. Obreros de Cananea 746, Industrial los Belenes, 45150',
            'tel' => Str::random(9),
            'nombre_enlace' => 'Mario López',
            'cargo_enlace' => 'director',
            'email' => Str::random(10).'@gmail.com',
            'activo' => true,
            'id_municipio' => 2,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
