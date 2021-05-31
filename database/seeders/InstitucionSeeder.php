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
            'nombre' => 'Ninguna',
            'domicilio' => '',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 1
        ]);
//2
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto tecnológico superior de Cocula José Mario Molina Pasquel y Henríquez',
            'domicilio' => 'Calle Tecnológico 1000',
            'activo' => true,
            'id_municipio' => 24,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 3
        ]);
//3
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad de Artes Digitales',
            'domicilio' => 'Calle Andrés Terán #1106, Mezquitan Country, 44620',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 4
        ]);
//4
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Metropolitana de Occidente',
            'domicilio' => 'Calzada Independencia Norte #393',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 5
        ]);
//5
        DB::table('instituciones')->insert([
            'nombre' => 'UNIDADES ACADÉMICAS TECMM',
            'domicilio' => 'Camino Arenero 1101, 45019',
            'activo' => true,
            'id_municipio' => 20,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 6
        ]);
//6
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Politécnica de la Zona Metropolitana de Guadalajara',
            'domicilio' => 'Carretera Tlajomulco - Santa Fé Km. 3.5 No.595 Lomas de Tejeda, 45641',
            'activo' => true,
            'id_municipio' => 98,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 7
        ]);
//7
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Tecnológica de Jalisco',
            'domicilio' => 'Colonia, Luis J. Jiménez 577, 1o. de Mayo, 44979',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 8
        ]);
//8
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto Nórdico Universitario',
            'domicilio' => 'Calz. del Federalismo Sur 425, Col Americana, Zona Centro, 44100',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 9
        ]);
//9
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad América Latina',
            'domicilio' => 'Av Guadalupe 5715, Plaza Guadalupe, 45030',
            'activo' => true,
            'id_municipio' => 119,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 10
        ]);
//10
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad del Pacifico',
            'domicilio' => 'Calle Jose Guadalupe Montenegro 2198, Colonia Obrera, Moderna, 44190',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 11
        ]);
//11
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Siglo XXI',
            'domicilio' => 'C. Morelos 1514, Ladrón de Guevara, Americana, 44101',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 12
        ]);
//12
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Enrique Díaz de León',
            'domicilio' => 'Av. Miguel Hidalgo y Costilla 1393, Ladrón de Guevara, Americana, 44600',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 13
        ]);
//13
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto Tecnológico de Tlajomulco',
            'domicilio' => 'Km 10 carr Tlajomulco, Cto. Metropolitano Sur, 45640',
            'activo' => true,
            'id_municipio' => 98,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 14
        ]);
//14
        DB::table('instituciones')->insert([
            'nombre' => 'Tecnológico Nacional de México',
            'domicilio' => 'Av. Tecnológico s/n Col, La Primavera, 47829',
            'activo' => true,
            'id_municipio' => 36,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 15
        ]);
//15
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto Tecnológico José Mario Molina Pasquel y Henríquez Campus Arandas (UA Arandas)',
            'domicilio' => 'Calle José Guadalupe Tejeda Vázquez 557, S/C,',
            'activo' => true,
            'id_municipio' => 7,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 16
        ]);
//16
        DB::table('instituciones')->insert([
            'nombre' => 'Centro Profesional Universitario REBSAMEN EGLOFF A.C',
            'domicilio' => '44100 Calle Francisco Indalecio Madero 411-A, Calle Francisco I. Madero 385, 44100',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 17
        ]);
//17
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Azteca de Guadalajara',
            'domicilio' => 'Av Juárez 340, Zona Centro, 44100',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 18
        ]);
//18
        DB::table('instituciones')->insert([
            'nombre' => 'Centro Jalisciense Virtual',
            'domicilio' => 'Av Río Nilo 3168, Jardines de la Paz',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 19
        ]);
//19
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto Tecnológico José Mario Molina Pasquel y Henríquez Campus Arandas (UA Zapopan)',
            'domicilio' => 'Camino Arenero 1101, 45019',
            'activo' => true,
            'id_municipio' => 119,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 20
        ]);
//20
        DB::table('instituciones')->insert([
            'nombre' => 'Instituto Tecnológico José Mario Molina Pasquel y Henríquez Campus El Grullo',
            'domicilio' => 'Carretera el Grullo - Ejutla. Kilómetro 5, Puerta de Barro, 48740',
            'activo' => true,
            'id_municipio' => 33,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 21
        ]);
//21
        DB::table('instituciones')->insert([
            'nombre' => 'ITESO',
            'domicilio' => 'Anillo Perif. Sur Manuel Gómez Morín 8585, Santa María Tequepexpan, 45604',
            'activo' => true,
            'id_municipio' => 80,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 22
        ]);
//22
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Cuauhtemoc',
            'domicilio' => 'Av. Del Bajío 5901, El Bajío, 45019',
            'activo' => true,
            'id_municipio' => 119,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 23
        ]);
//23
        DB::table('instituciones')->insert([
            'nombre' => 'COBAEJ',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 24
        ]);
//24
        DB::table('instituciones')->insert([
            'nombre' => 'CECYTEJ',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 25
        ]);
//25
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad Antopológica de Guadalajara',
            'domicilio' => 'Av. Adolfo López Mateos Sur 4195, La Calma, 45070',
            'activo' => true,
            'id_municipio' => 119,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 26
        ]);
//26
        DB::table('instituciones')->insert([
            'nombre' => 'CONALEP',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 27
        ]);
//27
        DB::table('instituciones')->insert([
            'nombre' => 'IDEFT',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 28
        ]);
//28
        DB::table('instituciones')->insert([
            'nombre' => 'INEEJAD',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 30
        ]);
//29
        DB::table('instituciones')->insert([
            'nombre' => 'PARTICULARES',
            'domicilio' => 'Varios',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 31
        ]);
//30
        DB::table('instituciones')->insert([
            'nombre' => 'Universidad de la Ciénega',
            'domicilio' => 'Av. 16 de Septiembre 114, Centro, 44100',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 32
        ]);
//31
        DB::table('instituciones')->insert([
            'nombre' => 'Universitarios de Occidente',
            'domicilio' => 'Av. de las Américas 3, Ladrón de Guevara, Ladron De Guevara, 44600',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 33
        ]);
//32
        DB::table('instituciones')->insert([
            'nombre' => 'Centro de Estudios Superiores en Ciencias de la Salud CESCS',
            'domicilio' => 'Sierra Mojada 950, Independencia Oriente, 44340',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 34
        ]);
//33
        DB::table('instituciones')->insert([
            'nombre' => 'UTEG  Centro Universitario',
            'domicilio' => 'Av Enrique Díaz de León Sur 80, Col Americana, Americana, 44160',
            'activo' => true,
            'id_municipio' => 40,
            'fecha_creacion' => Carbon::now(),
            'id_user' => 35
        ]);
//34
        // DB::table('instituciones')->insert([
        //     'nombre' => 'Ninguna',
        //     'domicilio' => '',
        //     'activo' => true,
        //     'id_municipio' => 40,
        //     'fecha_creacion' => Carbon::now(),
        //     'id_user' => 37
        // ]);
    }
}
