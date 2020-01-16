<?php

use Illuminate\Database\Seeder;

class galeriaTiposSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock inicial' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte personal total y labores' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte ventas y gastos del día' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock final del día' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte compras, ventas, creditos del día' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte ocurrrencias en fábrica' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte liquidación de ventas' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock inicial y final productos terminados' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte movimientos bancarios' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte mantenimiento de vehículo' ]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte de ventas del día' ]);
    }
}
