<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_creditos', function (Blueprint $table) {
						$table->bigIncrements('id');
						
						$table->bigInteger('liquidacion_id')->unsigned();
						$table->integer('idPresentacion');
						$table->string('presentacion');
						$table->string('cliente')->default('');
						$table->string('nota');
						$table->integer('cantidad');
						$table->float('precio');
						$table->float('total');

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
        Schema::dropIfExists('ventas_creditos');
    }
}
