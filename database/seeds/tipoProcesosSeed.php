<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoProcesosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_procesos')->insert([
            'tipo' => 'Sin acción',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Adelanto de personal',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Amortización',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Anticipo de ventas',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Apertura de Caja',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Artículo retirado',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Artículo vigente',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Bonos',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Capital cancelado',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Cierre de Caja',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Comisión',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Compra',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Crédito Finalizado',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Crédito nuevo',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Descuento',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Desembolso',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Desembolso',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Egreso de caja',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'En almacén',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'En prórroga',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'En remate',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'En venta',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Entrada a almacén',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Entrada de cochera',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Entrada stock',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Esperando en cochera',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Extraviado',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Fin de proceso',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Gastos de almuerzo',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Gastos relacionados con la empresa',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Ingreso a caja',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Inventariado en almacén',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Inyección de dinero',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'No encontrado en almacén',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Pago de personal',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Pago de servicios',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Pago parcial',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Penalización',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Pendiente de pago',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Pérdida',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Retirado de cochera',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Retiro',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Retiro por socios',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Salida de almacén',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Vencidos',
            'suma' => '0'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Vendido',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Venta',
            'suma' => '1'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Modicicado',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Eliminado',
            'suma' => '2'
          ]);
          DB::table('tipo_procesos')->insert([
            'tipo' => 'Creado',
            'suma' => '2'
          ]);
    }
}
