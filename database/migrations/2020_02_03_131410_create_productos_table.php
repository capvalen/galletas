<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('tipo_productos_id')->unsigned();
						$table->bigInteger('tipo_displays_id')->unsigned();
						$table->bigInteger('marca_displays_id')->unsigned();
						$table->bigInteger('unidades_id')->unsigned();
						$table->float('cantidad_x_display')->comment('cuantas unidades juntas existen');// 10
						$table->float('cantidad')->comment('total en la unidad más basica, und, kg, lt'); //Ejm: 18
						$table->float('peso')->comment('peso en la unidad más basica, und, kg, lt');
						$table->boolean('activo')->default(1);
						$table->timestamps();
						
						$table->foreign('tipo_productos_id')->references('id')->on('grupos');
						$table->foreign('tipo_displays_id')->references('id')->on('tipo_displays');
						$table->foreign('marca_displays_id')->references('id')->on('marca_displays');
						$table->foreign('unidades_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
