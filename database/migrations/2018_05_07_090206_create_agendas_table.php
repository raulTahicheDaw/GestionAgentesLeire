<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->string('motivo',256);
            $table->string('lugar',150);
            $table->date('fecha');
            $table->dateTime('hora',5);
            $table->longText('acuerdos')->nulable();
            $table->longText('observaciones')->nulable();
            $table->timestamps();
            $table->foreign('id_cliente')
                ->references('id')->on('clientes')
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
        Schema::dropIfExists('agendas');
    }
}
