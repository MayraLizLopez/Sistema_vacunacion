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
            'direccion' => 'Calz Independencia Nte 5075, Huentitán El Bajo, 44250 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'CODE ALCALDE',
            'direccion' => 'Av. Fray Antonio Alcalde 1360, Miraflores, 44270 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE AGUA AZUL',
            'direccion' => 'Calz Independencia Sur 973, Centro, 44100 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE SAN RAFAEL',
            'direccion' => 'Ciencias 2844, San Rafael, 44810 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE ÁVILA CAMACHO',
            'direccion' => 'Av. Manuel Ávila Camacho S/N, Lomas del Country, 44610 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'CODE PARADERO',
            'direccion' => 'Blvd. Gral. Marcelino García Barragán 1820, Atlas, 44870 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'PARQUE SAN JACINTO',
            'direccion' => 'Av San Jacinto S/N, San Andrés, 44810 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'Antigua Penal Oblatos',
            'direccion' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 40,
            'nombre' => 'MUSEO DEL EJÉRCITO Y LA FUERZA AÉREA',
            'direccion' => 'Calle Valentín Gómez Farías 600, Reforma, 44890 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'Escuela Secundaria Técnica Estatal Nº 5 Laura Rosales Arreola',
            'direccion' => 'Calle, Atotonilco El Alto 1, 45412 Tonalá, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA FEDERAL JUAN ESCUTIA',
            'direccion' => 'CALLE ATOTONILCO EL ALTO 201, , COL. JALISCO. 45403TONALÁ',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'EXPLANA CS EL ROSARIO',
            'direccion' => 'AV. CONSTITUCIÓN 7, COL. EL ROSARIO, 45416 TONALÁ',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA OLLINCA # 101',
            'direccion' => 'AVENIDA CENTRAL 20 AV. RIO NILO',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA 171',
            'direccion' => 'CALLE HIDALGO 150, SAN GASPAR',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA JOSÉ MARTI T/M',
            'direccion' => 'MARCOS LARA 15, COL. SANTA PAULA. CP 45426. TONALA, JALSICO.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'COBAEJ PLANTEL 1 BASILIO VADILLO',
            'direccion' => 'CALLE ANTONIO CASO, BASILIO BADILLO, 45406 TONALÁ, MÉXICO',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'CUTONALÁ',
            'direccion' => 'AV. NUEVO PERIFÉRICO NO.555 EJIDO SAN JOSÉ TATEPOSCO, C.P. 45425, TONALÁ JALISCO',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA MIGUEL HIDALGO T/M Y MORELOS T/V',
            'direccion' => 'REFORMA 23, SANTA CRUZ DE LAS HUERTAS, 45400 TONALÁ, JALISCO.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA PRIMARIA VALENTIN GOMEZ FARIAS',
            'direccion' => 'LOMA LARGA SUR #7798, LOMA DORADA',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'DOMO MIGUEL HIDALGO UNIDAD DEPORTIVA',
            'direccion' => 'CALLE HIDALGO 411-421',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 101,
            'nombre' => 'ESCUELA SECUNDARIA TECNICA 34',
            'direccion' => 'CALLE TENAMAXTLI S/N PUENTE GRANDE',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'ESTADIO AKRON',
            'direccion' => 'C. Cto. JVC 2800, El Bajío, 45019 Zapopan, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'Auditorio Benito Juárez',
            'direccion' => 'Av. Mariano Barcena s/n, Auditorio, 45190 Zapopan, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 119,
            'nombre' => 'UAG PEATONAL (ESTADIO 3 DE MARZO) y UAG Drive Thru',
            'direccion' => 'Av. Patria 1201, Uag, 45110 Zapopan, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'ESCUELA PRIMARIA REVOLUCIÓN',
            'direccion' => 'Calle veinte de Mayo 6608, Centro, 45690 Las Pintas, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'Escuela Secundaria General No. 81 "Lic. J. Jesús González Gallo"',
            'direccion' => 'Calle Sta Fe 55, Minerales, Centro, 45693 Las Pintitas, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 35,
            'nombre' => 'ESCUELA PRIMARIA SOR JUANA  INES DE LA CRUZ ',
            'direccion' => '',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'RANCHO SANTA MARÍA',
            'direccion' => 'Cto. Metropolitano Sur 9, 45640 Tlajomulco de Zúñiga, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'CU TLAJOMULCO UDG',
            'direccion' => 'Carretera Tlajomulco Santa fe,KM 3.5 #595.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'CENTRO MULTIDISCIPLINARIO EL VALLE',
            'direccion' => 'Rio de Janeiro S/N, Chulavista, 45653 Hacienda Santa Fe, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'PREPARATORIA REGIONAL SAN JOSÉ',
            'direccion' => 'Concepción del Valle S/N, 45653 La Unión del Cuatro, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 98,
            'nombre' => 'ARENA VFG',
            'direccion' => 'Km 20, Carr. Guadalajara - Chapala S/N, Fraccionamiento Los Silos, 45678 Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. ROSALES',
            'direccion' => 'Rosales #385',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SN. MARTÍN DE LAS FLORES',
            'direccion' => 'Calle Francisco Villa #6',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
        
        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SAN PEDRITO',
            'direccion' => 'Calle Puerto Liverpool #20',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. Cerro del Cuatro',
            'direccion' => 'Calle Melcho Ocampo #52',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IMSS UMF 54',
            'direccion' => 'Vicente Guerrero 875',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Delegación Municipal San Pedrito',
            'direccion' => 'Puerto Campeche #4',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA ROSALÍA',
            'direccion' => 'Calle Enrique González Martínez #1030',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IPEJAL',
            'direccion' => 'Canchas de IPEJAL a un lado del Centro Cultural El Refugio, Tlaquepaque. Entre calle Florida y Cruz Verde',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DIF Tlaquepaque Sta. Rosalía',
            'direccion' => 'Av. Sta. Rosalía 1040, Lindavista',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Delegación Municipal San José Tateposco',
            'direccion' => 'Cruce Francisco I Madero con Calle Jesús García',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'IMSS CLÍNICA 14',
            'direccion' => 'Av. Revolución 2735, Jardines de la Paz, 44860 Guadalajara, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DIF LOS OLIVOS',
            'direccion' => 'González Gallo #1881',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA ANITA',
            'direccion' => 'Ramón Corona #258',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LAS JUNTAS',
            'direccion' => 'Calle Clemente Orozco #185, Las Juntas',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. BUENOS AIRES',
            'direccion' => 'Calle Manuel J. García # 7',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria Mixta 59',
            'direccion' => 'Constiticiónde 1857 No. 670, Fracc. Revolución',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Primaria Lázaro Cárdenas del Río',
            'direccion' => 'Calle Capulín entre calle mezquite',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria No. 23',
            'direccion' => 'Calle Glendale 292, Centro, 45570 San Pedro Tlaquepaque, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Primaria Lino Ruíz Arévalo',
            'direccion' => 'Calle Santa Rita esquina Jesus Michel Gonzalez, enfrente de la Parroquia Nueva Santa María',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SANTA MARÍA TEQUEPEXPAN',
            'direccion' => 'Ramón Corona #65',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LAS PINTAS DE ABAJO',
            'direccion' => 'CALLE LA PAZ S/N, LA LADRILLERA',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. LÓPEZ COTILLA',
            'direccion' => 'Jesús Ramírez #20 y López Cotilla',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CS. SAN JOSÉ TATEPOSCO',
            'direccion' => 'Prolongación Hidalgo #165',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'Secundaria Mixta 75',
            'direccion' => 'Bahía de Pichilingue No. 2725, Parque de Santa María',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'ITESO',
            'direccion' => 'Anillo Perif. Sur Manuel Gómez Morín 8585, Santa María Tequepexpan, 45604 San Pedro Tlaquepaque, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'CENTRO CULTURAL EL REFUGIO',
            'direccion' => 'Calle Donato Guerra 160, San Juan, 45500 San Pedro Tlaquepaque, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

        DB::table('sedes')->insert([
            'id_municipio' => 80,
            'nombre' => 'DELEGACIÓN MUNICIPAL TOLUQUILLA',
            'direccion' => 'Calle José González Gallo 52, Tlaquepaque, 45610 San Pedro Tlaquepaque, Jal.',
            'cupo' => 30,
            'activo' => true,
            'fecha_creacion' => Carbon::now(),
        ]);

    }
}
