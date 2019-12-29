<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idInsumoMarca')->unsigned();
            $table->string('detalle');
            $table->float('cantidad');
            $table->float('precio');
            $table->float('subtotal');
            $table->bigInteger('idUnidad')->unsigned();
            $table->boolean('activo');
            $table->timestamps();

            $table->foreign('idInsumoMarca')->references('id')->on('insumos_marcas');
            $table->foreign('idUnidad')->references('id')->on('unidades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras_detalles');
    }
}
