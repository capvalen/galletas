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
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock inicial' , 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte personal total y labores', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte ventas y gastos del día', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock final del día', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte gastos, compras, ventas del día', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte créditos del día', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte ocurrrencias en fábrica', 'grupo_id' => 1]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte liquidación de ventas', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte stock inicial y final productos terminados', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte gastos del día', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte movimientos bancarios', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte mantenimiento de vehículo', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte pendientes de ventas', 'grupo_id' => 4]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte de ventas del día', 'grupo_id' => 2]);
			DB::table('galeria_tipos')->insert([ 'descripcion' => 'Reporte de gastos del día', 'grupo_id' => 2]);
    }
}
