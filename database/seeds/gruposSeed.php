<?php

use Illuminate\Database\Seeder;

class gruposSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
				//
				DB::table('grupos')->insert([ 'grupo' => 'Fábrica' ]);
				DB::table('grupos')->insert([ 'grupo' => 'Stefano' ]);
				DB::table('grupos')->insert([ 'grupo' => 'Victor' ]);
				DB::table('grupos')->insert([ 'grupo' => 'Oficina Huancayo' ]);
				DB::table('grupos')->insert([ 'grupo' => 'Emiliano' ]);
    }
}
