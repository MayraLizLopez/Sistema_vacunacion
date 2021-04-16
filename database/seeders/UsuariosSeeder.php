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
            'id_insti' => 1,
            'cargo' => 'Director',
            'rol' => 'Administrador General',
            'tel' => '123456788',
            'email' => 'mayra@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//3
        DB::table('usuarios')->insert([
            'nombre' => 'Rogelio Alejandro',
            'ape_pat' => 'Corona',
            'ape_mat' => 'Ramirez',
            'id_insti' => 2,
            'cargo' => 'Médico',
            'rol' => 'Enlace de institución',
            'tel' => '322 138 751',
            'email' => 'rogelio.corona@cocula.tecmm.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//4
        DB::table('usuarios')->insert([
            'nombre' => 'Karina Natali',
            'ape_pat' => 'Navarro',
            'ape_mat' => 'Márquez',
            'id_insti' => 3,
            'cargo' => 'Servicios Educativos (Vinculación/Documentación/Registro y Validación)',
            'rol' => 'Enlace de institución',
            'tel' => '333 628 242',
            'email' => 'knavarro@uartesdigitales.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//5
        DB::table('usuarios')->insert([
            'nombre' => 'Elvira',
            'ape_pat' => 'Pérez',
            'ape_mat' => 'González',
            'id_insti' => 4,
            'cargo' => 'Administradora',
            'rol' => 'Enlace de institución',
            'tel' => '331 116 6199',
            'email' => 'eperez@universidadmetropolitana.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//6
        DB::table('usuarios')->insert([
            'nombre' => 'Aarón Paul',
            'ape_pat' => 'Arrayga',
            'ape_mat' => 'González',
            'id_insti' => 5,
            'cargo' => 'Médico Escolar',
            'rol' => 'Enlace de institución',
            'tel' => '331 455 2057',
            'email' => 'paul.arrayga@chapala.tecmm.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//7
        DB::table('usuarios')->insert([
            'nombre' => 'Obed Moacyr',
            'ape_pat' => 'Mendoza',
            'ape_mat' => 'Jiménez',
            'id_insti' => 6,
            'cargo' => 'Profesor de Tiempo Completo de la licenciatura en Terapia Física',
            'rol' => 'Enlace de institución',
            'tel' => '111 111 1111',
            'email' => 'obed.mendoza@upzmg.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//8
        DB::table('usuarios')->insert([
            'nombre' => 'Sandra',
            'ape_pat' => 'Ribeiro',
            'ape_mat' => 'Valle',
            'id_insti' => 7,
            'cargo' => 'Secretaria de Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '331 679 5322',
            'email' => 'sribeiro@utj.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//9
        DB::table('usuarios')->insert([
            'nombre' => 'Pedro MIguel',
            'ape_pat' => 'Guillén',
            'ape_mat' => 'Mejía',
            'id_insti' => 8,
            'cargo' => 'Coordinador general de Instituto Nórdico Universitario',
            'rol' => 'Enlace de institución',
            'tel' => '333 336 9830',
            'email' => 'direccioncalidadeducativa.inu@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//10
        DB::table('usuarios')->insert([
            'nombre' => 'Juan Manuel',
            'ape_pat' => 'Ruíz',
            'ape_mat' => 'Torres',
            'id_insti' => 9,
            'cargo' => 'Director del Depto. de Servicio Social y Titulación',
            'rol' => 'Enlace de institución',
            'tel' => '334 777 7100',
            'email' => 'vinculacion@ual.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//11
        DB::table('usuarios')->insert([
            'nombre' => 'Clara',
            'ape_pat' => 'Camarena',
            'ape_mat' => 'Ramirez',
            'id_insti' => 10,
            'cargo' => 'Direccion Academica y Control Escolar',
            'rol' => 'Enlace de institución',
            'tel' => '333 304 7617',
            'email' => 'clara.udp@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//12
        DB::table('usuarios')->insert([
            'nombre' => 'Víctor Manuel',
            'ape_pat' => 'González',
            'ape_mat' => 'Lozano',
            'id_insti' => 11,
            'cargo' => 'Director de Vínculación',
            'rol' => 'Enlace de institución',
            'tel' => '333 827 5445',
            'email' => 'gonzalezlozano@uniso.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//13
        DB::table('usuarios')->insert([
            'nombre' => 'Rosana',
            'ape_pat' => 'Guerrero',
            'ape_mat' => 'Hernández',
            'id_insti' => 12,
            'cargo' => 'Coordinadora de servicio social y prácticas profesionales',
            'rol' => 'Enlace de institución',
            'tel' => '333 827 300',
            'email' => 'practicas@unedl.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//14
        DB::table('usuarios')->insert([
            'nombre' => 'Rodolfo',
            'ape_pat' => 'Cortez',
            'ape_mat' => 'Iñiguez',
            'id_insti' => 13,
            'cargo' => 'Subdirector de Planeación y Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '331 868 4154',
            'email' => 'plan_tlajomulco@tecnm.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//15
        DB::table('usuarios')->insert([
            'nombre' => 'Mateo',
            'ape_pat' => 'López',
            'ape_mat' => 'Valdovinos',
            'id_insti' => 14,
            'cargo' => 'Director TecNM/Campus Ocotlán',
            'rol' => 'Enlace de institución',
            'tel' => '392 922 463',
            'email' => 'dir_ocotlan@tecnm.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//16
        DB::table('usuarios')->insert([
            'nombre' => 'Fracisco',
            'ape_pat' => 'López',
            'ape_mat' => 'López',
            'id_insti' => 15,
            'cargo' => 'Enlace de Servicios Generales y Mantenimiento de la UA Arandas',
            'rol' => 'Enlace de institución',
            'tel' => '348 109 4020',
            'email' => 'francisco.lopez@arandas.tecmm.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//17
        DB::table('usuarios')->insert([
            'nombre' => 'Silvia Sarahi',
            'ape_pat' => 'Suaréz',
            'ape_mat' => 'Bermejo',
            'id_insti' => 16,
            'cargo' => 'Cordinación y vinculación académica',
            'rol' => 'Enlace de institución',
            'tel' => '332 608 1797',
            'email' => 'vinculacionrebsamen@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//18
        DB::table('usuarios')->insert([
            'nombre' => 'Fernando',
            'ape_pat' => 'Jiménez',
            'ape_mat' => 'Martínez',
            'id_insti' => 17,
            'cargo' => 'Representante Legal',
            'rol' => 'Enlace de institución',
            'tel' => '331 025 6754',
            'email' => 'uniazteca@hotmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//19
        DB::table('usuarios')->insert([
            'nombre' => 'Iliana Penélope',
            'ape_pat' => 'Moya',
            'ape_mat' => 'Gutiérrez',
            'id_insti' => 18,
            'cargo' => 'Directora',
            'rol' => 'Enlace de institución',
            'tel' => '331 357 3573',
            'email' => 'ilianapenelope@yahoo.com.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//20
        DB::table('usuarios')->insert([
            'nombre' => 'Edgar Rodolfo',
            'ape_pat' => 'Ruíz',
            'ape_mat' => 'Becerra',
            'id_insti' => 19,
            'cargo' => 'Jefe del Departamento de Servicio Estudiantiles',
            'rol' => 'Enlace de institución',
            'tel' => '331 570 8870',
            'email' => 'edgar.ruiz@zapopan.tecmm.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//21
        DB::table('usuarios')->insert([
            'nombre' => 'Jorge',
            'ape_pat' => 'Rodríguez',
            'ape_mat' => 'Martínez',
            'id_insti' => 20,
            'cargo' => '-',
            'rol' => 'Enlace de institución',
            'tel' => '111 111 1111',
            'email' => 'jorge.rodriguez@elgrullo.tecmm.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//22
        DB::table('usuarios')->insert([
            'nombre' => 'Guillermo',
            'ape_pat' => 'Rosas',
            'ape_mat' => '',
            'id_insti' => 21,
            'cargo' => 'Director de Egresados',
            'rol' => 'Enlace de institución',
            'tel' => '333 814 4942',
            'email' => 'egresados@iteso.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//23
        DB::table('usuarios')->insert([
            'nombre' => 'Víctor Emmanuel',
            'ape_pat' => 'Márquez',
            'ape_mat' => 'Mendoza',
            'id_insti' => 22,
            'cargo' => 'Director General',
            'rol' => 'Enlace de institución',
            'tel' => '333 682 0550',
            'email' => 'vmarquez@ucg.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//24
        DB::table('usuarios')->insert([
            'nombre' => 'Sarahí',
            'ape_pat' => 'García',
            'ape_mat' => '',
            'id_insti' => 23,
            'cargo' => 'Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '111 111 1111',
            'email' => 'sarahi.garcia@cobaej.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//25
        DB::table('usuarios')->insert([
            'nombre' => 'Jael',
            'ape_pat' => 'Chamu',
            'ape_mat' => '',
            'id_insti' => 24,
            'cargo' => 'Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '333 724 9006',
            'email' => 'jael.chamu@cecytejalisco.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//26
        DB::table('usuarios')->insert([
            'nombre' => 'Bárbara',
            'ape_pat' => 'Dávalos',
            'ape_mat' => 'Cervantes',
            'id_insti' => 25,
            'cargo' => 'Maestra',
            'rol' => 'Enlace de institución',
            'tel' => '333 826 1363',
            'email' => 'barbaradavalos@unag.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//27
        DB::table('usuarios')->insert([
            'nombre' => 'Genoveva',
            'ape_pat' => 'Gutiérrez',
            'ape_mat' => '',
            'id_insti' => 26,
            'cargo' => 'Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '331 600 9438',
            'email' => 'genoveva.gutierrez@conalepjalisco.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//28
        DB::table('usuarios')->insert([
            'nombre' => 'Rafael',
            'ape_pat' => 'Gallegos',
            'ape_mat' => '',
            'id_insti' => 27,
            'cargo' => 'Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '331 795 0662',
            'email' => 'rafael.gallegos@ideft.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//29
        DB::table('usuarios')->insert([
            'nombre' => 'Edgar',
            'ape_pat' => 'Aldana',
            'ape_mat' => 'Rangel',
            'id_insti' => 25,
            'cargo' => 'Licenciado',
            'rol' => 'Enlace de institución',
            'tel' => '333 826 1363',
            'email' => 'edgaraldana@unag.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//30
        DB::table('usuarios')->insert([
            'nombre' => 'José',
            'ape_pat' => 'Cruz',
            'ape_mat' => '',
            'id_insti' => 28,
            'cargo' => 'Vinculación',
            'rol' => 'Enlace de institución',
            'tel' => '331 014 8678',
            'email' => 'jal_admin@inea.gob.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//31
        DB::table('usuarios')->insert([
            'nombre' => 'Katherine Michel',
            'ape_pat' => 'Vera',
            'ape_mat' => 'Estrada',
            'id_insti' => 29,
            'cargo' => 'Enlace Subsecretaría de Educación Media Superior SEJ',
            'rol' => 'Enlace de institución',
            'tel' => '331 244 2012',
            'email' => 'Katherine.vera@jalisco.gob.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//32
        DB::table('usuarios')->insert([
            'nombre' => 'Bertha Alicia',
            'ape_pat' => 'Angel',
            'ape_mat' => 'García',
            'id_insti' => 30,
            'cargo' => 'Sin Cargo',
            'rol' => 'Enlace de institución',
            'tel' => '331 255 8148',
            'email' => 'aangel@ucienega.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//33
        DB::table('usuarios')->insert([
            'nombre' => 'Nancy Y.',
            'ape_pat' => 'Zavala',
            'ape_mat' => 'Andrade',
            'id_insti' => 31,
            'cargo' => 'Relaciones Públicas',
            'rol' => 'Enlace de institución',
            'tel' => '333 630 6000',
            'email' => 'udeomkt@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//34
        DB::table('usuarios')->insert([
            'nombre' => 'Marvin Azdruval Israel',
            'ape_pat' => 'Cisneros',
            'ape_mat' => 'Mireles',
            'id_insti' => 32,
            'cargo' => 'Coordinador de servicios social y práticas profesionales CESCS',
            'rol' => 'Enlace de institución',
            'tel' => '331 345 5832',
            'email' => 'contacto@cescs.com.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//35
        DB::table('usuarios')->insert([
            'nombre' => 'Krishna Gpe',
            'ape_pat' => 'Palma',
            'ape_mat' => 'Hernández',
            'id_insti' => 33,
            'cargo' => 'Jefa de Unidad de Servicio Social y Prácticas Profesionales',
            'rol' => 'Enlace de institución',
            'tel' => '107 880 00',
            'email' => 'krishna.palma@uteg.edu.mx',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//36
        // DB::table('usuarios')->insert([
        //     'nombre' => '',
        //     'ape_pat' => '',
        //     'ape_mat' => '',
        //     'id_insti' => 34,
        //     'cargo' => '',
        //     'rol' => 'Enlace de institución',
        //     'tel' => '',
        //     'email' => '',
        //     'password' => Hash::make('1234'),
        //     'activo' => true,
        //     'fecha_creacion' => Carbon::now(),
        // ]);
//37
        DB::table('usuarios')->insert([
            'nombre' => 'Marcela',
            'ape_pat' => '',
            'ape_mat' => '',
            'id_insti' => 1,
            'cargo' => 'Director',
            'rol' => 'Administrador General',
            'tel' => '123456788',
            'email' => 'marcela@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
//38
        DB::table('usuarios')->insert([
            'nombre' => 'Marco',
            'ape_pat' => '',
            'ape_mat' => '',
            'id_insti' => 1,
            'cargo' => 'Encargado',
            'rol' => 'Enlace de institución',
            'tel' => '123456888',
            'email' => 'marco@gmail.com',
            'password' => Hash::make('1234'),
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
