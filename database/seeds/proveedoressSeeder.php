<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class proveedoressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            'ruc'=> '00000000',
            'razonSocial'=> 'Proveedor simple',
            'direccion' =>'',
            'celular' =>'',
            'contacto' =>'',
        ]);
    }
}
