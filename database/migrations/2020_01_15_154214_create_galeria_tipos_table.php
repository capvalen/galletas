<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_tipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->bigInteger('grupo_id')->unsigned();
            $table->boolean('activo')->default(1);
						$table->timestamps();
						
						$table->foreign('grupo_id')->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeria_tipos');
    }
}
