<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('campaña');
            $table->date('fecha_lanzamiento');
            $table->date('fecha_vencimiento');
            $table->longText('coberturas');
            $table->longText('observaciones');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->unsignedInteger('id_ramo');
            $table->foreign('id_ramo')
                ->references('id')->on('ramos')
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
        Schema::dropIfExists('productos');
    }
}
