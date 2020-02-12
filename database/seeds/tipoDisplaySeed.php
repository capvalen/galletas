<?php

use Illuminate\Database\Seeder;

class tipoDisplaySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tipo_displays')->insert(['descripcion' => 'Bolsa']);
      DB::table('tipo_displays')->insert(['descripcion' => 'Display']);
      DB::table('tipo_displays')->insert(['descripcion' => 'Molde']);
      DB::table('tipo_displays')->insert(['descripcion' => 'Domo']);
      DB::table('tipo_displays')->insert(['descripcion' => 'Pirotín']);
      DB::table('tipo_displays')->insert(['descripcion' => 'Ninguno']);
    }
}
