<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_procesos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->tinyInteger('suma')->comment('0 restar, 1 sumar, 2 no aplica ninguno');
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
        Schema::dropIfExists('tipo_procesos');
    }
}
