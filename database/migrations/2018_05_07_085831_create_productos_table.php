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
            $table->boolean('campania');
            $table->date('fecha_lanzamiento')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->longText('coberturas')->nullable();
            $table->longText('observaciones')->nullable();
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
