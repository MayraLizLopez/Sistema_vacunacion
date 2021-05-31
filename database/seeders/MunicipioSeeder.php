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

        DB::table('municipios')->insert([
            'nombre' => 'Bolaños',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Cabo Corriente',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Cañadas de Obregón',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Casimiro Castillo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Chapala',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Chimaltitán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Chiquilistlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Cihuatlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Cocula',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Colotlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Concepción de Buenos Aires',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Cuautitlán de García Barragán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Cuautla',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Cuquío',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Degollado',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ejutla',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'El Arenal',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'El Grullo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'El Limón',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'El Salto',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Encarnación de Díaz',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Etzatlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Gómez Farías',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Guachinango',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Guadalajara',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Hostotipaquillo',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Huejúcar',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Huejuquilla el Alto',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Ixtlahuacán de los Membrillos',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ixtlahuacán del Río',
            'activo'=> true
        ]);
        
        DB::table('municipios')->insert([
            'nombre' => 'Jalostotitlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Jamay',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Jesús María',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Jilotlán de los Dolores',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Jocotepec',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Juanacatlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Juchitlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'La Barca',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'La Huerta',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'La Manzanilla de la Paz',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Lagos de Moreno',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Magdalena',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Mascota',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Mazamitla',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Mexticacán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Mezquitic',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Mixtlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ocotlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Ojuelos de Jalisco',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Pihuamo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Poncitlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Puerto Vallarta',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Quitupan',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Cristóbal de la Barranca',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Diego de Alejandría',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Gabriel',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Ignacio Cerro Gordo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Juan de los Lagos',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Juanito de Escobedo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Julián',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Marcos',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Martín de Bolaños',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Martín Hidalgo',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Miguel el Alto',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'San Pedro Tlaquepaque',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Sebastián del Oeste',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Santa María de los Ángeles',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Santa María del Oro',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Sayula',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tala',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Talpa de Allende',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tamazula de Gordiano',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tapalpa',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tecalitlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Techaluta de Montenegro',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tecolotlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Teocaltiche',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Teocuitatlán de Corona',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tepatitlán de Morelos',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tequila',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Teuchitlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tizapán el Alto',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tlajomulco de Zúñiga',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tolimán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tomatlán',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tonalá',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tonaya',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tonila',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Totatiche',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tototlán',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Tuxcacuesco',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tuxcueca',
            'activo'=> true
        ]);
        
        DB::table('municipios')->insert([
            'nombre' => 'Tuxpan',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Unión de San Antonio',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Unión de Tula',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Valle de Guadalupe',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Valle de Juárez',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Villa Corona',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Villa Guerrero',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Villa Hidalgo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Villa Purificación',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Yahualica de González Gallo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Zacoalco de Torres',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Zapopan',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Zapotiltic',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Zapotitlán de Vadillo',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Zapotlán del Rey',
            'activo'=> true
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Zapotlán el Grande',
            'activo'=> true
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Zapotlanejo',
            'activo'=> true
        ]);
    }
}
