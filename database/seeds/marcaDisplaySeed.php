<?php

use Illuminate\Database\Seeder;

class marcaDisplaySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('marca_displays')->insert(['descripcion' => 'Marie']);
      DB::table('marca_displays')->insert(['descripcion' => 'Rey del centro']);
      DB::table('marca_displays')->insert(['descripcion' => 'Sin marca']);
    }
}
