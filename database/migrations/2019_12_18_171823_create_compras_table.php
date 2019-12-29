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
            $table->bigInteger('idComprbante')->unsigned();
            $table->date('fecha');
            $table->bigInteger('idProceso')->unsigned();
            $table->string('serie');
            $table->string('correlativo');
            $table->bigInteger('idMoneda')->unsigned();
            $table->bigInteger('idProveedor')->unsigned();
            $table->string('detalle');
            $table->integer('user_id')->unsigned();
            $table->boolean('activo');
            $table->float('exonerado');
            $table->float('subtotal');
            $table->float('igv');
            $table->float('total');
            $table->timestamps();

            $table->foreign('idProceso')->references('id')->on('tipo_procesos');
            $table->foreign('idComprbante')->references('id')->on('comprobantes');
            $table->foreign('idMoneda')->references('id')->on('monedas');
            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->foreign('user_id')->references('id')->on('users');            
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
