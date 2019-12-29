<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_marcas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idInsumo')->unsigned();
            $table->bigInteger('idMarca')->unsigned();
            $table->string('descipcion');
            $table->timestamps();

            $table->foreign('idInsumo')->references('id')->on('insumos');
            $table->foreign('idMarca')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos_marcas');
    }
}
