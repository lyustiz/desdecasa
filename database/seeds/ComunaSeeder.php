<?php

use Illuminate\Database\Seeder;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comuna')->insert([
            ['co_comuna' =>	1,  'nb_comuna' => 'Comuna 1',  'id_zona' => 1, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	2,  'nb_comuna' => 'Comuna 2',  'id_zona' => 1, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	3,  'nb_comuna' => 'Comuna 3',  'id_zona' => 1, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	4,  'nb_comuna' => 'Comuna 4',  'id_zona' => 2, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	5,  'nb_comuna' => 'Comuna 5',  'id_zona' => 2, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	6,  'nb_comuna' => 'Comuna 6',  'id_zona' => 2, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	7,  'nb_comuna' => 'Comuna 7',  'id_zona' => 2, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	8,  'nb_comuna' => 'Comuna 8',  'id_zona' => 2, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	9,  'nb_comuna' => 'Comuna 9',  'id_zona' => 1, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	10, 'nb_comuna' => 'Comuna 10', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	11, 'nb_comuna' => 'Comuna 11', 'id_zona' => 4, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	12, 'nb_comuna' => 'Comuna 12', 'id_zona' => 4, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	13, 'nb_comuna' => 'Comuna 13', 'id_zona' => 3, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	14, 'nb_comuna' => 'Comuna 14', 'id_zona' => 3, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	15, 'nb_comuna' => 'Comuna 15', 'id_zona' => 3, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	16, 'nb_comuna' => 'Comuna 16', 'id_zona' => 4, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	17, 'nb_comuna' => 'Comuna 17', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	18, 'nb_comuna' => 'Comuna 18', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	19, 'nb_comuna' => 'Comuna 19', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	20, 'nb_comuna' => 'Comuna 20', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	21, 'nb_comuna' => 'Comuna 21', 'id_zona' => 3, 'id_status' => 1, 'id_usuario' => 1],
            ['co_comuna' =>	22, 'nb_comuna' => 'Comuna 22', 'id_zona' => 5, 'id_status' => 1, 'id_usuario' => 1],
        ]);

        //// php artisan db:seed --class=ComunaSeeder
    }
}


