<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_stocks', function (Blueprint $table) {
						$table->bigIncrements('id');
						
						$table->bigInteger('liquidacion_id')->unsigned();
						$table->string('presentacion');
						$table->integer('pentapeaks')->comment('salida pentapeaks')->default(0);
						$table->integer('oficina')->comment('salida oficina')->default(0);
						$table->integer('fabrica')->comment('salida fabrica')->default(0);
						$table->integer('total')->default(0);
						$table->integer('final')->comment('stock final')->default(0);
						$table->string('observacion')->default('')->nullable();

						$table->foreign('liquidacion_id')->references('id')->on('liquidacions');
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
        Schema::dropIfExists('ventas_stocks');
    }
}
