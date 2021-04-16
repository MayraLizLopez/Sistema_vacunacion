<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'ITVER',
            'direccion' => 'Calzada Independencia Norte #393 Guadalajara, Jalisco, México',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'UV',
            'direccion' => 'Camino Arenero 1101, 45019 Zapopan, Jal.',
            'cupo' => 28,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'LA SALLE',
            'direccion' => 'Colonia, Luis J. Jiménez 577, 1o. de Mayo, 44979 Guadalajara, Jal.',
            'cupo' => 12,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'SETMAR',
            'direccion' => 'cCalz. del Federalismo Sur 425, Col Americana, Zona Centro, 44100 Guadalajara, Jal.',
            'cupo' => 22,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'UVM',
            'direccion' => 'Calle Jose Guadalupe Montenegro 2198, Colonia Obrera, Moderna, 44190 Guadalajara, Jal.',
            'cupo' => 18,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
