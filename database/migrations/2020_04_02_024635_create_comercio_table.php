<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComercioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comercio', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nb_cliente', 100);
			$table->string('nb_fiscal', 100);
			$table->string('tx_nit', 12)->nullable();
			$table->string('tx_descripcion', 200)->nullable();
			$table->integer('id_departamento');
			$table->integer('id_ciudad');
			$table->integer('id_zona');
			$table->integer('id_comuna');
			$table->integer('id_barrio');
			$table->string('tx_direccion', 100)->nullable();
			$table->integer('id_tipo_comercio');
			$table->integer('id_tipo_pago');
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
        Schema::dropIfExists('comercio');
    }
}
