<?php

use Illuminate\Database\Seeder;

class categoriaComprasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('categoria_compras')->insert(['descripcion'=> 'Compras generales' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Insumos' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Materiales' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Combustible' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Servicios' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Gastos gerenciales' ]);
			DB::table('categoria_compras')->insert(['descripcion'=> 'Caja chica' ]);
    }
}
