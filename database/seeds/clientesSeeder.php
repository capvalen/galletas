<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class clientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clientes')->insert([
            'ruc'=> '00000000',
            'razonSocial'=> 'Cliente simple',
            'direccion' =>'',
            'celular' =>''
        ]);
        
    }
}
