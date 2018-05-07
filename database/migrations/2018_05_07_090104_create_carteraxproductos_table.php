<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteraxproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteraxproductos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cartera')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->date('fecha_efecto');
            $table->date('vencimiento');
            $table->string('forma_pago');
            $table->string('numero_poliza')->unique();
            $table->boolean('primer_recibo_fisico');
            $table->longText('observaciones');
            $table->timestamps();
            $table->foreign('id_cartera')
                ->references('id')->on('carteras')
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
        Schema::dropIfExists('carteraxproductos');
    }
}
