<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AgendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) {
            \DB::table('agendas')->insert(array(
                'id_cliente' => $faker->numberBetween($min = 1,$max = 150),
                'motivo' => $faker->optional()->text($maxNbChars = 50),
                'lugar' => $faker->streetAddress,
                'fecha' => $faker->dateTimeThisMonth,
                'color' => $faker->randomElement($array = array ('red','blue','yellow')),
                'acuerdos' => $faker->optional()->text($maxNbChars = 100),
                'observaciones' => $faker->optional()->text($maxNbChars = 50),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
    }
}