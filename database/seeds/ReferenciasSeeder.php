<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReferenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 30; $i++) {
            \DB::table('referencias')->insert(array(
                'nombre' => $faker->name($gender = null),
                'apellidos' => $faker->lastName,
                'dni'  => $faker->randomDigitNotNull,
                'email'  => $faker->email,
                'telefono'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
                'fechaNacimiento'=>$faker->dateTimeThisCentury($max = 'now', $timezone = null),
                'sexo'=>$faker->randomElement($array = array('Hombre','Mujer')),
                'domicilio'=>$faker->streetAddress,
                'localidad'=>$faker->randomElement($array = array('Arrecife','Tahiche','San Bartolome','Tías','Puerto del Carmen')),
                'codigoPostal'=>$faker->numberBetween($min = 35000, $max = 36000),
                'provincia'=>$faker->randomElement($array = array('Las Palmas','Tenerife')),
                'profesion'=>$faker->jobTitle,
                'nacionalidad'=>$faker->randomElement($array=array('Española','Colombiana','Inglesa','Francesa')),
                'contacto'=>$faker->optional()->name($gender = null),
                'intereses'=>$faker->optional()->text($maxNbChars = 100),
                'compañia_origen'=>$faker->randomElement($array=array('Ocaso','Mafre','Santa Lucía','Generali')),
                'observaciones'=>$faker->optional()->text($maxNbChars = 100),
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ));
        }
    
    }
}
