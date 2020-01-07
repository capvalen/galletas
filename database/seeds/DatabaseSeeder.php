<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->truncarTablas([
            'users', 'unidades', 'monedas', 'monedas_procesos', 'clientes', 'proveedores', 'tipo_procesos', 'categoria_compras', 'comprobantes', 'marcas', 'insumos'
        ]);
        $this->call(UsersSeeder::class);
        $this->call(unidadesSeeder::class);
        $this->call(monedasSeeder::class);
        $this->call(monedasProcesoSeeder::class);
        $this->call(clientesSeeder::class);
        $this->call(proveedoressSeeder::class);
        $this->call(tipoProcesosSeed::class);
        $this->call(categoriaComprasSeed::class);
        $this->call(comprobanteSeed::class);
        $this->call(marcasSeed::class);
        $this->call(insumoSeed::class);
        

    }
    protected function truncarTablas(array $tablas){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
