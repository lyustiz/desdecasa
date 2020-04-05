<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarrioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrio', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('co_barrio')->unique();
			$table->string('nb_barrio', 30);
			$table->integer('id_comuna');
			$table->float('nu_latitud', 2, 7)->nullable();
			$table->float('nu_longitud', 2, 7)->nullable();
			$table->string('tx_observaciones', 100)->nullable();
			$table->integer('id_status');
			$table->integer('id_usuario');
			$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barrio');
    }
}
