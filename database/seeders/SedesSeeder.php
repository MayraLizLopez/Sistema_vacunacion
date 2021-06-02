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
            'id_municipio' => 40,
            'nombre' => 'CUAAD',
            'direccion' => 'Calz Independencia Nte 5075, Guadalajara, Jal.',
            'colonia' => 'Huentitán El Bajo',
            'cp' => '44250',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'CODE ALCALDE',
            'direccion' => 'Av. Fray Antonio Alcalde 1360, Guadalajara, Jal.',
            'colonia' => 'Miraflores',
            'cp' => '44270',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE AGUA AZUL',
            'direccion' => 'Calz Independencia Sur 973.',
            'colonia' => 'Centro',
            'cp' => '44100',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE SAN RAFAEL',
            'direccion' => 'Ciencias 2844.',
            'colonia' => 'San Rafael',
            'cp' => '44810',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE ÁVILA CAMACHO',
            'direccion' => 'Av. Manuel Ávila Camacho S/N.',
            'colonia' => 'Lomas del Country',
            'cp' => '44610',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'CODE PARADERO',
            'direccion' => 'Blvd. Gral. Marcelino García Barragán 1820.',
            'colonia' => 'Atlas',
            'cp' => '44870',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE SAN JACINTO',
            'direccion' => 'Av San Jacinto S/N.',
            'colonia' => 'San Andrés',
            'cp' => '44810',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'Antigua Penal Oblatos',
            'direccion' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'MUSEO DEL EJÉRCITO Y LA FUERZA AÉREA',
            'direccion' => 'Calle Valentín Gómez Farías 600.',
            'colonia' => 'Reforma',
            'cp' => '44890',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'Escuela Secundaria Técnica Estatal Nº 5 Laura Rosales Arreola',
            'direccion' => 'Calle, Atotonilco El Alto 1',
            'colonia' => '',
            'cp' => '45412',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA FEDERAL JUAN ESCUTIA',
            'direccion' => 'CALLE ATOTONILCO EL ALTO 201',
            'colonia' => 'COL. JALISCO',
            'cp' => '45403',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'EXPLANA CS EL ROSARIO',
            'direccion' => 'AV. CONSTITUCIÓN 7',
            'colonia' => 'COL. EL ROSARIO',
            'cp' => '45416',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA OLLINCA # 101',
            'direccion' => 'AVENIDA CENTRAL 20 AV. RIO NILO',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA 171',
            'direccion' => 'CALLE HIDALGO 150',
            'colonia' => 'SAN GASPAR',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA JOSÉ MARTI T/M',
            'direccion' => 'MARCOS LARA 15.',
            'colonia' => 'COL. SANTA PAULA',
            'cp' => '45426',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'COBAEJ PLANTEL 1 BASILIO VADILLO',
            'direccion' => 'CALLE ANTONIO CASO.',
            'colonia' => 'BASILIO BADILLO',
            'cp' => '45406',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'CUTONALÁ',
            'direccion' => 'AV. NUEVO PERIFÉRICO NO.555',
            'colonia' => 'EJIDO SAN JOSÉ TATEPOSCO',
            'cp' => '45425',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA MIGUEL HIDALGO T/M Y MORELOS T/V',
            'direccion' => 'REFORMA 23',
            'colonia' => 'SANTA CRUZ DE LAS HUERTAS',
            'cp' => '45400',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA VALENTIN GOMEZ FARIAS',
            'direccion' => 'LOMA LARGA SUR #7798',
            'colonia' => 'LOMA DORADA',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'DOMO MIGUEL HIDALGO UNIDAD DEPORTIVA',
            'direccion' => 'CALLE HIDALGO 411-421',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA TECNICA 34',
            'direccion' => 'CALLE TENAMAXTLI S/N PUENTE GRANDE',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'ESTADIO AKRON',
            'direccion' => 'C. Cto. JVC 2800.',
            'colonia' => 'El Bajío',
            'cp' => '45019',
            'cupo' => 30,
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'Auditorio Benito Juárez',
            'direccion' => 'Av. Mariano Barcena s/n, Auditorio',
            'cp' => '45190',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'UAG PEATONAL (ESTADIO 3 DE MARZO) y UAG Drive Thru',
            'direccion' => 'Av. Patria 1201',
            'colonia' => 'Uag',
            'cp' => '45110',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'ESCUELA PRIMARIA REVOLUCIÓN',
            'direccion' => 'Calle veinte de Mayo 6608.',
            'colonia' => 'Centro Las Pintas',
            'cp' => '45690',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'Escuela Secundaria General No. 81 "Lic. J. Jesús González Gallo"',
            'direccion' => 'Calle Sta Fe 55, Minerales',
            'colonia' => 'Centro Las Pintitas',
            'cp' => '45693',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'ESCUELA PRIMARIA SOR JUANA  INES DE LA CRUZ ',
            'direccion' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'RANCHO SANTA MARÍA',
            'direccion' => 'Cto. Metropolitano Sur 9',
            'cp' => '45640',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'CU TLAJOMULCO UDG',
            'direccion' => 'Carretera Tlajomulco Santa fe,KM 3.5 #595.',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'CENTRO MULTIDISCIPLINARIO EL VALLE',
            'direccion' => 'Rio de Janeiro S/N, Chulavista',
            'colonia' => 'Hacienda Santa Fe',
            'cp' => '45653',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'PREPARATORIA REGIONAL SAN JOSÉ',
            'direccion' => 'Concepción del Valle S/N.',
            'colonia' => 'La Unión del Cuatro',
            'cp' => '45653',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'ARENA VFG',
            'direccion' => 'Km 20, Carr. Guadalajara - Chapala S/N.',
            'colonia' => 'Fraccionamiento Los Silos',
            'cp' => '45678',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. ROSALES',
            'direccion' => 'Rosales #385',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SN. MARTÍN DE LAS FLORES',
            'direccion' => 'Calle Francisco Villa #6',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SAN PEDRITO',
            'direccion' => 'Calle Puerto Liverpool #20',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. Cerro del Cuatro',
            'direccion' => 'Calle Melcho Ocampo #52',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IMSS UMF 54',
            'direccion' => 'Vicente Guerrero 875',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Delegación Municipal San Pedrito',
            'direccion' => 'Puerto Campeche #4',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA ROSALÍA',
            'direccion' => 'Calle Enrique González Martínez #1030',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IPEJAL',
            'direccion' => 'Canchas de IPEJAL a un lado del Centro Cultural El Refugio',
            'cruce_calles' => 'Entre calle Florida y Cruz Verde',
            'colonia' => '',
            'cp' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DIF Tlaquepaque Sta. Rosalía',
            'direccion' => 'Av. Sta. Rosalía 1040',
            'colonia' => 'Lindavista',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Delegación Municipal San José Tateposco',
            'direccion' => 'Cruce Francisco I Madero con Calle Jesús García',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IMSS CLÍNICA 14',
            'direccion' => 'Av. Revolución 2735',
            'colonia' => 'Jardines de la Paz',
            'cp' => '44860',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DIF LOS OLIVOS',
            'direccion' => 'González Gallo #1881',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA ANITA',
            'direccion' => 'Ramón Corona #258',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LAS JUNTAS',
            'direccion' => 'Calle Clemente Orozco #185',
            'colonia' => 'Las Juntas',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. BUENOS AIRES',
            'direccion' => 'Calle Manuel J. García #7',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria Mixta 59',
            'direccion' => 'Constiticiónde 1857 No. 670',
            'colonia' => 'Fracc. Revolución',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Primaria Lázaro Cárdenas del Río',
            'direccion' => 'Calle Capulín',
            'cruce_calles' => 'entre calle mezquite',
            'cp' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria No. 23',
            'direccion' => 'Calle Glendale 292.',
            'colonia' => 'Centro',
            'cp' => '45570',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Primaria Lino Ruíz Arévalo',
            'direccion' => 'Calle Santa Rita esquina Jesus Michel Gonzalez',
            'cruce_calles' => 'enfrente de la Parroquia Nueva Santa María',
            'cp' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA MARÍA TEQUEPEXPAN',
            'direccion' => 'Ramón Corona #65',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LAS PINTAS DE ABAJO',
            'direccion' => 'CALLE LA PAZ S/N',
            'colonia' => 'LA LADRILLERA',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LÓPEZ COTILLA',
            'direccion' => 'Jesús Ramírez #20 y López Cotilla',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SAN JOSÉ TATEPOSCO',
            'direccion' => 'Prolongación Hidalgo #165',
            'colonia' => '',
            'cp' => '',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria Mixta 75',
            'direccion' => 'Bahía de Pichilingue No',
            'colonia' => 'Parque de Santa María',
            'cp' => '2725',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'ITESO',
            'direccion' => 'Anillo Perif. Sur Manuel Gómez Morín 8585,  San Pedro Tlaquepaque, Jal.',
            'colonia' => 'Santa María Tequepexpan',
            'cp' => '45604',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CENTRO CULTURAL EL REFUGIO',
            'direccion' => 'Calle Donato Guerra 160.',
            'colonia' => 'San Juan',
            'cp' => '45500',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DELEGACIÓN MUNICIPAL TOLUQUILLA',
            'direccion' => 'Calle José González Gallo 52.',
            'colonia' => 'Tlaquepaque',
            'cp' => '45610',
            'cruce_calles' => '',
            'georeferencia' => '',
            'nombre_encargado' => '',
            'tel_encargado' => '',
            'email_encargado' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

    }
}
