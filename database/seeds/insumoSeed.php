<?php

use Illuminate\Database\Seeder;

class insumoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
				//
			DB::table('insumos')->insert([ 'descripcion' => 'Harina' ]);
			DB::table('insumos')->insert([ 'descripcion' => 'Mantequilla' ]);
			DB::table('insumos')->insert([ 'descripcion' => 'Azúcar' ]);
			DB::table('insumos')->insert([ 'descripcion' => 'Huevo' ]);
			DB::table('insumos')->insert([ 'descripcion' => 'Levadura' ]);
			DB::table('insumos')->insert([ 'descripcion' => 'Leche' ]);
    }
}
