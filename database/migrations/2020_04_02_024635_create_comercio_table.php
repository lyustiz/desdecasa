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
			$table->string('nb_comercio', 100);
			$table->string('nb_fiscal', 100);
			$table->string('tx_nit', 12)->nullable();
			$table->string('tx_descripcion', 200)->nullable();
			$table->integer('id_departamento')->nullable();
			$table->integer('id_ciudad')->nullable();
			$table->integer('id_zona')->nullable();
			$table->integer('id_comuna')->nullable();
			$table->integer('id_barrio')->nullable();
			$table->string('tx_direccion', 100)->nullable();
			$table->integer('id_tipo_comercio')->nullable();
			$table->integer('id_tipo_pago')->nullable();
			$table->string('tx_latitud', 20)->nullable();
			$table->string('tx_longitud', 20)->nullable();
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
