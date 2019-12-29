<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idComprobante')->unsigned();
            $table->date('fecha');
            $table->bigInteger('idCategoriaCompras')->unsigned();
            $table->bigInteger('idProceso')->unsigned();
            $table->string('serieCorrelativo')->nullable();
            $table->bigInteger('idMoneda')->unsigned();
            $table->bigInteger('idProveedor')->unsigned();
            $table->string('detalle')->nullable();
            $table->integer('user_id')->unsigned();
            $table->boolean('esCredito')->default(0)->comment('0 para No, 1 para Si');
            $table->boolean('tieneIGV')->default(1)->comment('0 para No, 1 para Si');
            $table->boolean('activo');
            $table->float('exonerado');
            $table->float('subtotal');
            $table->float('igv');
            $table->float('total');
            $table->timestamps();

            $table->foreign('idProceso')->references('id')->on('tipo_procesos');
            $table->foreign('idComprobante')->references('id')->on('comprobantes');
            $table->foreign('idMoneda')->references('id')->on('monedas');
            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->foreign('user_id')->references('id')->on('users');            
            $table->foreign('idCategoriaCompras')->references('id')->on('categoria_compras');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
