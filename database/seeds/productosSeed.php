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
				'tipo_productos_id' => '' ,
				'tipo_displays_id' => '' ,
				'marca_displays_id' => '' ,
				'unidades_id' => '' ,
				'cantidad_x_display' => '' ,
				'cantidad' => '' ,
				'peso' => '' 
			]);
    }
}
