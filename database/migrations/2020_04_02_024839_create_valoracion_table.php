<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_comercio')->unsigned();
            $table->string('tx_valoracion', 200);
			$table->integer('nu_valoracion')->unsigned();
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
        Schema::dropIfExists('valoracion');
    }
}
