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
            $table->string('apellidos',100);
            $table->string('domicilio',150);
            $table->string('localidad',50);
            $table->string('codigoPostal',5);
            $table->string('provincia',50);
            $table->string('email',150);
            $table->char('sexo');
            $table->string('dni');
            $table->string('telefono',12);
            $table->date('fechaNacimiento');
            $table->string('nacionalidad');
            $table->string('intereses',256);
            $table->string('compañia_origen',100);
            $table->longText('observaciones');
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
