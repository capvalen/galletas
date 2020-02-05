<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasCobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_cobranzas', function (Blueprint $table) {
						$table->bigIncrements('id');
						
						$table->bigInteger('liquidacion_id')->unsigned();

						$table->string('cliente')->default('');
						$table->float('deuda');
						$table->float('acuenta');
						$table->float('saldo');
						$table->string('nota');

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
        Schema::dropIfExists('ventas_cobranzas');
    }
}
