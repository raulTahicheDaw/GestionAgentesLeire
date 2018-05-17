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
            $table->string('apellidos',100)->nulable();
            $table->string('domicilio',150)->nulable();
            $table->string('localidad',50)->nulable();
            $table->string('codigoPostal',5)->nulable();
            $table->string('provincia',50)->nulable();
            $table->string('email',150)->nulable();
            $table->string('sexo');
            $table->string('profesion')->nullable();
            $table->string('dni')->nulable();
            $table->string('contacto')->nulable();
            $table->string('telefono',12);
            $table->date('fechaNacimiento')->nulable();
            $table->string('nacionalidad')->nulable();
            $table->string('intereses',256)->nulable();
            $table->string('compañia_origen',100)->nulable();
            $table->longText('observaciones')->nulable();
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
