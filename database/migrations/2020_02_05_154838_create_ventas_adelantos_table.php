<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasAdelantosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_adelantos', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('liquidacion_id')->unsigned();
						$table->string('cliente')->default('');
						$table->float('monto');
						$table->float('cantidad');
						$table->date('fecha');

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
        Schema::dropIfExists('ventas_adelantos');
    }
}
