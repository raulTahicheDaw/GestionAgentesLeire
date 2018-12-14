<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['usuario' => 'admin', 'password' => bcrypt('password'),'activo'=>1, 'idrol' => 1 ]);

        $categorias = ['General','Especial','Puntual'];
        $faker = Faker::create();
        for ($i=0; $i < count($categorias); $i++) {
            \DB::table('categorias')->insert(array(
                'nombre' => $categorias[$i],
                'descripcion' => $faker->text($maxNbChars = 50),
                'activo'=> 1,
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ));
        }

        $ramos = ['Vida','Hogar','Accidentes'];
        $faker = Faker::create();
        for ($i=0; $i < count($ramos); $i++) {
            \DB::table('categorias')->insert(array(
                'nombre' => $ramos[$i],
                'descripcion' => $faker->text($maxNbChars = 50),
                'activo'=> 1,
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ));
        }
    }
}
