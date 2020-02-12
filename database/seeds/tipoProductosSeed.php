<?php

use Illuminate\Database\Seeder;

class tipoProductosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('tipo_productos')->insert(['descripcion' => 'Galleta de agua']);
			DB::table('tipo_productos')->insert(['descripcion' => 'Galleta de letras']);
			DB::table('tipo_productos')->insert(['descripcion' => 'Pan']);
			DB::table('tipo_productos')->insert(['descripcion' => 'Keke']);
			DB::table('tipo_productos')->insert(['descripcion' => 'Ninguno']);
    }
}
