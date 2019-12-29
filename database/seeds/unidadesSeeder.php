<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class unidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            'descripcion' => 'Unidad',
            'abreviatura'=> 'Und',
            'sunat'=> 'NIU',
        ]);
        DB::table('unidades')->insert([
            'descripcion' => 'Kilo',
            'abreviatura'=> 'Kg',
            'sunat'=> 'KGM',
        ]);
        DB::table('unidades')->insert([
            'descripcion' => 'Litro',
            'abreviatura'=> 'Lt',
            'sunat'=> 'LTR',
        ]);
        DB::table('unidades')->insert([
            'descripcion' => 'Metro',
            'abreviatura'=> 'm',
            'sunat'=> 'MTR',
        ]);
        DB::table('unidades')->insert([
            'descripcion' => 'Lata',
            'abreviatura'=> 'Lata',
            'sunat'=> 'CA',
        ]);
        DB::table('unidades')->insert([
            'descripcion' => 'Taza',
            'abreviatura'=> 'Taza',
            'sunat'=> 'CU',
        ]);
    }
}
