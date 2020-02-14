<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_gastos', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('liquidacion_id')->unsigned();
						$table->float('monto');
						$table->string('descripcion')->default('')->nullable();
						$table->bigInteger('idComprobante')->default(0)->nullable();
						$table->string('comprobante')->default('')->nullable();
						$table->bigInteger('empresa_id')->default(0)->nullable();
						$table->string('destino')->default('')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_gastos');
    }
}
