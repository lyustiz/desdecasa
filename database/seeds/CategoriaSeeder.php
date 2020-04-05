<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categoria')->insert([
            ['nb_categoria' => 'Ropa', 'tx_icono' => "mdi-tshirt-crew", 'tx_foto' => "ropa.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Calzado', 'tx_icono' => "mdi-shoe-formal", 'tx_foto' => "calzado.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Comida', 'tx_icono' => "mdi-food", 'tx_foto' => "comida.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Belleza', 'tx_icono' => "mdi-hair-dryer", 'tx_foto' => "belleza.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Mercado', 'tx_icono' => "mdi-cart", 'tx_foto' => "mercado.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Mensajeria', 'tx_icono' => "mdi-motorbike", 'tx_foto' => "mensajeria.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Drogueria', 'tx_icono' => "mdi-needle", 'tx_foto' => "drogueria.jpg", 'id_status' => 1, 'id_usuario' => 1],
            ['nb_categoria' => 'Ferreteria', 'tx_icono' => "mdi-hammer-screwdriver", 'tx_foto' => "ferreteria.jpg", 'id_status' => 1, 'id_usuario' => 1],
        ]);
    }
}
