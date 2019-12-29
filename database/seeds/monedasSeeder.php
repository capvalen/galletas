<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class monedasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monedas')->insert([
            'descripcion' => 'Soles',
            'simbolo' => 'S/',
        ]);
        DB::table('monedas')->insert([
            'descripcion' => 'Dólares',
            'simbolo' => '$',
        ]);
    }
}
