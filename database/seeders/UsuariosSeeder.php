<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuarios')->insert([
            'nombre' => 'Jaime',
            'ape_pat' => 'León',
            'ape_mat' => 'Murrieta',
            'id_insti' => 1,
            'cargo' => 'Director',
            'rol' => 'Administrador General',
            'tel' => '123456789',
            'email' => 'jaime@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Mayra',
            'ape_pat' => 'Lopez',
            'ape_mat' => 'Barrios',
            'id_insti' => 2,
            'cargo' => 'Director',
            'rol' => 'Administrador General',
            'tel' => '123456788',
            'email' => 'mayra@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Arturo',
            'ape_pat' => 'Bravo',
            'ape_mat' => 'Baéz',
            'id_insti' => 2,
            'cargo' => 'Encargado',
            'rol' => 'Enlace de institución',
            'tel' => '123456888',
            'email' => 'arturo@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
