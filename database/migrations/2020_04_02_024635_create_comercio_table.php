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
			$table->integer('id_departamento')->unsigned()->nullable();
			$table->integer('id_ciudad')->unsigned()->nullable();
			$table->integer('id_zona')->unsigned()->nullable();
			$table->integer('id_comuna')->unsigned()->nullable();
			$table->integer('id_barrio')->unsigned()->nullable();
			$table->string('tx_direccion', 50)->nullable();
			$table->integer('id_tipo_comercio')->unsigned()->nullable();
            $table->integer('id_tipo_pago')->unsigned()->nullable();
            $table->integer('tx_foto',100)->nullable();
			$table->string('tx_latitud', 20)->nullable();
            $table->string('tx_longitud', 20)->nullable();
            $table->boolean('bo_abierto')->default(1)->comment('Comercio Abierto o cerrado');
			$table->string('tx_observaciones', 100)->nullable();
			$table->integer('id_status')->unsigned();
			$table->integer('id_usuario')->unsigned();
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
