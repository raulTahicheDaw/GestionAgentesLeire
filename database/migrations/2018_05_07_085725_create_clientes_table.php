<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellidos',100);
            $table->string('dni',10);
            $table->string('email',150);
            $table->string('telefono',12);
            $table->date('fechaNacimiento');
            $table->char('sexo');
            $table->string('domicilio',150);
            $table->string('localidad',50);
            $table->string('codigoPostal',5);
            $table->string('provincia',50);
            $table->string('cuentaBancaria',30);
            $table->string('profesion',50);
            $table->string('contacto',50);
            $table->boolean('activo');
            $table->longText('observaciones');
            $table->unsignedInteger('id_categoria');
            $table->timestamps();
            $table->foreign('id_categoria')
                ->references('id')->on('categorias')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
