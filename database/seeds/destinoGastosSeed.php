<?php

use Illuminate\Database\Seeder;

class destinoGastosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('destino_gastos')->insert([ 'destino' => 'Pentakeaks EIRL - Mantenimiento', 'empresa_id' => 1]);
			DB::table('destino_gastos')->insert([ 'destino' => 'Pentakeaks EIRL - Varios', 'empresa_id' => 1]);
			DB::table('destino_gastos')->insert([
				['destino' => 'Coorporación Marie EIRL - Compra Insumos', 'empresa_id' => 2],
				['destino' => 'Coorporación Marie EIRL - Varios', 'empresa_id' => 2],
				['destino' => 'Coorporación Marie EIRL - Caja Chica', 'empresa_id' => 2]
			]);
			DB::table('destino_gastos')->insert([
				['destino' => 'CISUSAJO EIRL - Compra Insumos', 'empresa_id' => 3],
				['destino' => 'CISUSAJO EIRL - Varios', 'empresa_id' => 3]
			]);
			DB::table('destino_gastos')->insert([
				['destino' => 'Fábrica Rey del Centro SRL - Compra Insumos', 'empresa_id' => 4],
				['destino' => 'Fábrica Rey del Centro SRL - Varios', 'empresa_id' => 4]
			]);
			DB::table('destino_gastos')->insert([
				['destino' => 'Fábrica Marie EIRL - Compra Insumos', 'empresa_id' => 4],
				['destino' => 'Fábrica Marie EIRL - Varios', 'empresa_id' => 4]
			]);
			DB::table('destino_gastos')->insert([
				['destino' => 'Gerencia - Varios', 'empresa_id' => 4]
			]);
    }
}
