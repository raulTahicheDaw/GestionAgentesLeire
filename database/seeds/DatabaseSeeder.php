<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ClientesSeeder');
        $this->call('ReferenciasSeeder');
        $this->call('AgendasSeeder');
        $this->call('UserSeeder'); //Inserta usuario admin/ password: 'password'
    }
}
