<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->date('fecha_efecto');
            $table->date('vencimiento');
            $table->string('forma_pago');
            $table->string('numero_poliza')->unique();
            $table->boolean('primer_recibo_fisico');
            $table->longText('observaciones');
            $table->foreign('id_cliente')
                ->references('id')->on('clientes')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_producto')
                ->references('id')->on('productos')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_productos');
    }
}
