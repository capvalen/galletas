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
				'cantidad_x_display' => '1.6' ,
				'cantidad' => '1' ,
				'peso' => '1.6',
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
				'cantidad_x_display' => '1.05' ,
				'cantidad' => '1' ,
				'peso' => '1.05',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '2' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '5' ,
				'cantidad' => '1' ,
				'peso' => '0.95',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '5' ,
				'cantidad' => '1' ,
				'peso' => '0.95',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => '5' ,
				'cantidad' => '1' ,
				'peso' => '0.7',
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 10 ,
				'cantidad' => 1 ,
				'peso' => 1.7,
				'descripcion' => '',
				'precio' => 0,
				'activo' => 1,
			]);
			DB::table('productos')->insert([
				'tipo_productos_id' => '1' ,
				'tipo_displays_id' => '2' ,
				'marca_displays_id' => '1' ,
				'unidades_id' => '2' ,
				'cantidad_x_display' => 10 ,
				'cantidad' => 1 ,
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
				'cantidad_x_display' => 10 ,
				'cantidad' => 1 ,
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
				'activo' => 1,
			]);
    }
}
