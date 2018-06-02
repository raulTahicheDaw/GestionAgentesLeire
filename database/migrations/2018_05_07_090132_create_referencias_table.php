<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellidos',100)->nullable();
            $table->string('domicilio',150)->nullable();
            $table->string('localidad',50)->nullable();
            $table->string('codigoPostal',5)->nullable();
            $table->string('provincia',50)->nullable();
            $table->string('email',150)->nullable();
            $table->string('sexo');
            $table->string('profesion')->nullable();
            $table->string('dni')->nullable();
            $table->string('contacto')->nullable();
            $table->string('telefono',12);
            $table->date('fechaNacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('intereses',256)->nullable();
            $table->string('compañia_origen',100)->nullable();
            $table->longText('observaciones')->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referencias');
    }
}
