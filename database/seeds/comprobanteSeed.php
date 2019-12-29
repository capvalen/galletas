<?php

use Illuminate\Database\Seeder;

class comprobanteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('comprobantes')->insert(['descripcion'=> 'Factura' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Boleta de venta' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Ticket' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Recibo' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Recibo por honorarios' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Sin comprobante' ]);
			DB::table('comprobantes')->insert(['descripcion'=> 'Otro' ]);
    }
}
