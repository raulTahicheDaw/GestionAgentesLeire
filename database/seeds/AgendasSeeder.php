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
        for ($i=0; $i < 50; $i++) {
            $cliente = \App\Cliente::all()->random();
            \DB::table('agendas')->insert(array(
                'id_cliente' => $cliente->id,
                'motivo' => $faker->text($maxNbChars = 50),
                'lugar' => $faker->streetAddress,
                'fecha' => $faker->dateTimeThisMonth,
                'hora' => $faker->time($format = 'H:i'),
                'acuerdos' => $faker->optional()->text($maxNbChars = 100),
                'observaciones' => $faker->optional()->text($maxNbChars = 50),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
        
    }
}
