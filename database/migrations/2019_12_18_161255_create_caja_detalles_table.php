<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('caja_id')->unsigned();
            
            $table->timestamps();
            $table->bigInteger('tipo_id')->unsigned();
            $table->string('detalle');
            
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('tipo_id')->references('id')->on('tipo_procesos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caja_detalles');
    }
}
