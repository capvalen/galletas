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
						'users', 'unidades', 'monedas', 'monedas_procesos', 'clientes', 'proveedores', 'tipo_procesos', 'categoria_compras', 'comprobantes', 'marcas', 'insumos', 'grupos', 'galeria_tipos',
						'marca_displays', 'tipo_displays', 'tipo_productos'
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
        $this->call(gruposSeed::class);
        $this->call(galeriaTiposSeed::class);
        $this->call(marcaDisplaySeed::class);
        $this->call(tipoDisplaySeed::class);
        $this->call(tipoProductosSeed::class);
        

    }
    protected function truncarTablas(array $tablas){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
