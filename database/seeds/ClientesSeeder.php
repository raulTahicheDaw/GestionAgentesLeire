<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) {
            \DB::table('clientes')->insert(array(
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
                'cuentaBancaria'=>$faker->bankAccountNumber,
                'profesion'=>$faker->jobTitle,
                'contacto'=>$faker->optional()->name($gender = null),
                'observaciones'=>$faker->optional()->text($maxNbChars = 100),
                'id_categoria'=>$faker->randomElement($array=array(1,2,3)),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
    }
}
