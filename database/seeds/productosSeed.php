<?php

use Illuminate\Database\Seeder;

class productosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('productos')->insert([
				'tipo_productos_id' => '5' ,
				'tipo_displays_id' => '6' ,
				'marca_displays_id' => '3' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => '0' ,
				'cantidad' => '0' ,
				'peso' => 0,
				'descripcion' => 'Nada',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '1' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '1.57' ,
				'cantidad' => '1' ,
				'peso' => '1.57',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '1' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '1.2' ,
				'cantidad' => '1' ,
				'peso' => '1.2',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '1' ,
				'marca_displays_id' => '2' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '1' ,
				'cantidad' => '1' ,
				'peso' => '1',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '2' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '950' ,
				'cantidad' => '5' ,
				'peso' => '4.75',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '950' ,
				'cantidad' => '5' ,
				'peso' => '4.75',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 700 ,
				'cantidad' => 5 ,
				'peso' => '3.5',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 18 ,
				'cantidad' => 10 ,
				'peso' => 1.7,
				'descripcion' => 'de 0.17kg',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '2' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 140 ,
				'cantidad' => 10 ,
				'peso' => 1.4,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '2' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 22 ,
				'cantidad' => 10 ,
				'peso' => 1.65,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '3' ,
				'tipo_displays_id' => '3' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1,
				'descripcion' => 'Blanco',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '3' ,
				'tipo_displays_id' => '3' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1,
				'descripcion' => 'Integral',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '4' ,
				'tipo_displays_id' => '4' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '4' ,
				'tipo_displays_id' => '5' ,
				'marca_displays_id' => '2' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '1' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1.2,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 0,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '5' ,
				'tipo_displays_id' => '6' ,
				'marca_displays_id' => '3' ,
				'unidades_id' => '1' ,
				'cantidad_x_display' => 1 ,
				'cantidad' => 1 ,
				'peso' => 1,
				'descripcion' => 'Pre mezcla x Saco',
				'precio' => 0,
				'activo' => 0,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 18 ,
				'cantidad' => 10 ,
				'peso' => 1.6,
				'descripcion' => 'de 0.16kg',
				'precio' => 0,
				'activo' => 1,
			]);
    }
}
