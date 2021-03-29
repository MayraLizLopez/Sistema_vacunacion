<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('municipios')->insert([
            'nombre' => 'Acatic',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Acatlán de Juárez',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Ahualulco de Mercado',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Amacueca',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Amatitlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ameca',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Arandas',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Atemajac de Brizuela',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ateno',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Atenguillo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Atotonilco de Alto',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Atoyac',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Autlán de Navarro',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Ayotlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ayutla',
            'activo'=> true
        ]);
    }
}
