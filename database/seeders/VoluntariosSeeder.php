<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VoluntariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voluntarios')->insert([
            'nombre' => 'Eduardo',
            'ape_pat' => 'López',
            'ape_mat' => 'Barrios',
            'id_insti' => 1,
            'id_municipio' => 25,
            'tel' => '123456789',
            'email' => 'eduardo@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Jovita',
            'ape_pat' => 'Murrieta',
            'ape_mat' => 'Gonzalez',
            'id_insti' => 2,
            'id_municipio' => 1,
            'tel' => '123455788',
            'email' => 'jovita@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Sahara',
            'ape_pat' => 'Murrieta',
            'ape_mat' => 'Gonzalez',
            'id_municipio' => 1,
            'id_insti' => 2,
            'tel' => '123456888',
            'email' => 'sarita@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Daniel',
            'ape_pat' => 'Lagos',
            'ape_mat' => 'Hernández',
            'id_insti' => 2,
            'id_municipio' => 60,
            'tel' => '123452588',
            'email' => 'daniel@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Karla',
            'ape_pat' => 'Leal',
            'ape_mat' => 'Sanchez',
            'id_insti' => 2,
            'id_municipio' => 68,
            'tel' => '1234454658',
            'email' => 'Karla@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Marina',
            'ape_pat' => 'Hernandez',
            'ape_mat' => 'Telles',
            'id_insti' => 1,
            'id_municipio' => 47,
            'tel' => '123542588',
            'email' => 'marina@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('voluntarios')->insert([
            'nombre' => 'Alexis',
            'ape_pat' => 'Ruiz',
            'ape_mat' => 'Hernández',
            'id_insti' => 3,
            'id_municipio' => 119,
            'tel' => '123542448',
            'email' => 'alex@gmail.com',
            'activo' => false,
            'eliminado' => false,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
