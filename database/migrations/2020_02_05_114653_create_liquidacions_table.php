<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->date('fecha');
						$table->string('vendedor')->default('')->nullable();
						$table->string('lugar')->default('')->nullable();
						$table->string('placa')->nullable();
						$table->integer('idUser')->unsigned();

						$table->float('sumaContado')->default(0);
						$table->float('sumaCobranza')->default(0);
						$table->float('sumaCredito')->default(0);
						$table->float('sumaGasto')->default(0);
						$table->float('sumaAdelanto')->default(0);
						$table->float('sumaEntregar')->default(0);
						$table->float('sumaEntregado')->default(0);
						
						$table->foreign('idUser')->references('id')->on('users');

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
        Schema::dropIfExists('liquidacions');
    }
}
