<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'domicilio' => Str::random(10),
            'id_munici' => 1,
            'tel' => Str::random(9),
            'nombre_enlace' => 'Juan Perez',
            'cargo_enlace' => 'director',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'activo' => true,
        ]);

        DB::table('instituciones')->insert([
            'nombre' => 'Auditorio Telmex',
            'domicilio' => Str::random(10),
            'tel' => Str::random(9),
            'nombre_enlace' => 'Mario López',
            'cargo_enlace' => 'director',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'activo' => true,
            'id_munici' => 2,
        ]);
    }
}
