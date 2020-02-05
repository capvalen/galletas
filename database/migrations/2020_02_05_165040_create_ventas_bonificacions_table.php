<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasBonificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_bonificacions', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('liquidacion_id')->unsigned();
						$table->integer('cantidad');
						$table->string('presentacion')->default('')->nullable();
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
        Schema::dropIfExists('ventas_bonificacions');
    }
}
