<?php

use Illuminate\Database\Seeder;

class marcasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('marcas')->insert(['descripcion'=> 'Sin marca' ]);
			DB::table('marcas')->insert(['descripcion'=> 'Granel' ]);
    }
}
