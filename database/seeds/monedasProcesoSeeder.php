<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class monedasProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Efectivo'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Depósito bancario'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Tarjeta Mastercard'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Tarjeta Visa'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Gratis'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Cheque'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'Transferencia bancaria'
        ]);
        DB::table('monedas_procesos')->insert([
            'descripcion' => 'P.O.S.'
        ]);
    }
}
