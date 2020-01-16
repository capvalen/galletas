<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idTipoGaleria')->unsigned();
            $table->bigInteger('grupo_id')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->text('observacion')->nullable(true)->default('');
            $table->text('foto');
            $table->boolean('activo')->default(1);
						$table->timestamps();
						
						$table->foreign('idTipoGaleria')->references('id')->on('galeria_tipos');
						$table->foreign('grupo_id')->references('id')->on('grupos');
						$table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galerias');
    }
}
