<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

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
    }
}
