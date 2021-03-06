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
            $table->string('dni',10)->unique();
            $table->string('email',150)->nullable();
            $table->string('telefono',12);
            $table->date('fechaNacimiento')->nullable();
            $table->string('sexo',10);
            $table->string('domicilio',150)->nullable();
            $table->string('localidad',50)->nullable();
            $table->string('codigoPostal',5)->nullable();
            $table->string('provincia',50)->nullable();
            $table->string('cuentaBancaria',30)->nullable();
            $table->string('profesion',150)->nullable();
            $table->string('contacto',50)->nullable();
            $table->boolean('activo')->default(1);
            $table->longText('observaciones')->nullable();
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
